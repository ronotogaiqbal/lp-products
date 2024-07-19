<?php namespace Rono\Vehicles\Components;
use Cms\Classes\ComponentBase;
use Config;
use Flash;
use Illuminate\Support\Facades\Log;
use Input;
use Mail;
use Request;
use Rono\Vehicles\Models\Bookings;
use Symfony\Component\Mime\Part\HtmlPart;
use Symfony\Component\Mime\Part\Multipart\AlternativePart;
use Symfony\Component\Mime\Part\TextPart;
use ValidationException;
use Validator;
use Rono\Vehicles\Components\ListVehicles;
use System\Models\MailTemplate;
class BookingForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Booking Form Component',
            'description' => 'Form booking standar'
        ];
    }
    public function defineProperties()
    {
        return [];
    }
    public function onSendNotif()
    {
        $email = post('email'); // requester
        if (empty($email)) {
            return;
        }
        if(post('testDrive')==1){
            $subject='Test Drive Request';
            $template='booking:requesttestdrive';
        }else{
            $subject='Booking Request';
            $template='booking:ordernow';
        }
        $vh=(new ListVehicles())->allvhtypes()->filter(function($e){
            return $e->id==post('jenisMobil');
        })->first();
        if(empty($vh)){
            return;
        }
        $adminEmail = env('MAIL_FROM_ADDRESS');//MailSettings::get('sender_email');
        $siteName = env('APP_NAME');//SystemSettings::get('app_name', 'default_site_name');
        $templates = MailTemplate::findOrMakeTemplate($template);
        $subject = $templates->subject;
		/*        
		$data = [
            'subject' => $subject,
            'name' => post('nama'),
            'vehicle_name' => $vh->vehicles->name,
            'name_type' => $vh->name_type,
            'transmission' => $vh->transmission,
            'contact_email' => $adminEmail,
            'contact_phone' => '123-456-7890',
            'company_name' => $siteName,
        ];
        */
        $data = [
            'subject' => $subject,
            'name' => post('nama'),
            'name_group' => post('namaGrup'),
            'company_name' => post('namaPerusahaan'),
            'id_karyawan' => post('idKaryawan'),
            'contact_email' => post('email'),
            'contact_phone' => post('nomorTelepon'),
            'domisili' => post('domisiliKTP'),
            'vehicle_name' => $vh->vehicles->name,
            'name_type' => $vh->name_type,
            'transmission' => $vh->transmission,
        ];
        Mail::sendTo($email,'booking:requesttestdrive', $data, function($message)use($subject,$adminEmail) {
            $message->subject($subject);
            $message->bcc('webepp21@gmail.com');
        });
         Mail::sendTo($adminEmail,'booking:ordernow', $data, function($message)use($subject,$adminEmail) {
            $message->subject($subject);
            $message->bcc('webepp21@gmail.com');
        });
   }
    public function onFormSubmit()
    {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptcha_secret = "6Lc5yRIqAAAAAExXVIzC5s759oY87Cv3X-angOaM";
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Make a request to the Google reCAPTCHA API
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
    $response_keys = json_decode($response, true);

    if (intval($response_keys["success"]) !== 1) {
        echo "Please complete the CAPTCHA.";
    } else {
        // Process the booking form submission
        //echo "CAPTCHA was completed successfully!";
        // Here you can add additional code to process the form data, such as saving it to a database or sending an email
        $rules = [
            'nama' => 'required',
            'namaPerusahaan' => 'required',
            'email' => 'required|email',
            'domisiliKTP' => 'required',
            'namaGrup' => 'required',
            'idKaryawan' => 'required',
            'nomorTelepon' => 'required|numeric',
            'jenisMobil' => 'required',
            'testDrive' => 'required',
            'agreement' => 'accepted',
        ];
        $messages = [
            'required' => ':attribute wajib diisi.',
            'email' => 'Email tidak valid.',
            'numeric' => ':attribute harus berupa angka.',
            'accepted' => 'Anda harus menyetujui persyaratan sebelum mengirimkan.'
        ];
        $validation = Validator::make(post(), $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }
        // Handle form submission (e.g., save data to the database, send an email, etc.)
        $booking = new Bookings();
        $booking->prospect_name = post('nama');
        $booking->prospect_company = post('namaPerusahaan');
        $booking->prospect_email = post('email');
        $booking->prospect_domisili = post('domisiliKTP');
        $booking->prospect_group = post('namaGrup');
        $booking->prospect_id_karyawan = post('idKaryawan');
        $booking->prospect_phone = post('nomorTelepon');
        $booking->vehicle_types_id = post('jenisMobil');
        $booking->test_drive = post('testDrive');
        $booking->tc_checked = post('agreement');
        $booking->save();
        $this->onSendNotif();
        return [
            // '.modal-body' => 'Form submitted successfully!',
            '.modal-content'  => $this->renderPartial('home/response-booking'),
        ];
            }
}
    }
    public function onRun(){
        // echo 'load templates';
    }
}
