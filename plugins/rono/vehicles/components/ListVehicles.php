<?php
namespace Rono\Vehicles\Components;
use Cms\Classes\ComponentBase;
use Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Rono\Vehicles\Models\Vehicles;
use Rono\Vehicles\Models\VehicleType;
class ListVehicles extends ComponentBase
{
    public $cars;
    public $currentPage;
    public $lastPage;
    public $perPage = 6;
    public function componentDetails()
    {
        return [
            'name' => 'List Vehicles Component',
            'description' => 'List vehicles...'
        ];
    }
    public function defineProperties()
    {
        return [];
    }
    public function mediaPath()
    {
        return Config::get('filesystems.disks.media.url',
            Config::get('cms.storage.media.path',
                Config::get('system.storage.media.path')
            )
        );
    }
    protected function distinct($params){
        $cacheKey = 'vehicle_types_' . md5(json_encode([$params]));
        $distinct = Cache::remember($cacheKey, now()->addHours(1), function () use($params) {
            return VehicleType::whereNotNull($params)
            ->where($params, '<>', '')
            ->distinct()
            ->get([$params]);
        });
        return $distinct;
    }
    protected function loadCars($search = '', $transmission = '', $model = '')
    {
        $cacheKey = 'vehicles_' . md5(json_encode([$search, $transmission, $model]));
        $vehicles = Cache::remember($cacheKey, now()->addHours(1), function () use ($search, $transmission, $model) {
            $query = Vehicles::with('types')->orderBy('order_view', 'asc');
            return $vehicles = $query->get();
        });
        $filteredVehicles = $vehicles->filter(function ($vehicle) use ($search, $transmission, $model) {
            $matchesSearch = !$search || stripos($vehicle->name, $search) !== false;
            $matchesTransmission = !$transmission || $transmission === 'all' || $vehicle->types->contains('transmission', $transmission);
            $matchesModel = !$model || $model === 'all' || $vehicle->types->contains('model', $model);
            return $matchesSearch && $matchesTransmission && $matchesModel;
        })->toArray();
        foreach ($filteredVehicles as &$car) {
            foreach ($car['types'] as &$type) {
                $type['image_path'] = $this->mediaPath() . $type['image_path'];
            }
        }
        return $filteredVehicles;
    }
    public function onFormSubmited(){
        print_r('formsbumit listvh');
    }
    public function allvhtypes(){
        $cacheKey = 'vehicle_types_all';
        $vehicleTypes = Cache::remember($cacheKey, now()->addHours(1), function () {
            $vt=VehicleType::with('vehicles')->get();
            return $vt->map(function($e){
                $e->image_path=$this->mediaPath().$e->image_path;
                return $e;
            });
        });
        return $vehicleTypes;
    }
    public function onFilterCars()
    {
        $this->onRun();
        return [
            '#vehicleContainer' => $this->renderPartial('home/car_list'),
            '#pagination' => $this->renderPartial('home/pagination')
        ];
    }
    public function onRun()
    {
            $this->currentPage = post('page') ? post('page') : 1;
            $search = post('search');
            $transmission = post('transmission');
            $model = post('model');
            $allCars = $this->loadCars($search, $transmission, $model);
            $offset = ($this->currentPage - 1) * $this->perPage;
            $this->page['currentPage'] = $this->currentPage;
            $this->page['cars'] = array_slice($allCars, $offset, $this->perPage);
            $this->lastPage = ceil(count($allCars) / $this->perPage);
            $this->page['lastPage'] = $this->lastPage;
            $this->page['models'] = $this->distinct('model');
            $this->page['transmissions'] = $this->distinct('transmission');
            $this->page['alltypes'] = $this->allvhtypes();
    }
}
