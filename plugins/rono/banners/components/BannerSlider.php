<?php namespace Rono\Banners\Components;
use Cms\Classes\ComponentBase;
use Input;
use Config;
use Rono\Banners\Models\Banners;
class BannerSlider extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Banner Slider Component',
            'description' => 'Banner Slider...'
        ];
    }
    public function defineProperties()
    {
        return [];
    }
    public function mediaPath(){
        return Config::get('filesystems.disks.media.url',
            Config::get('cms.storage.media.path',
                Config::get('system.storage.media.path')
            )
        );
    }
    public function onRun(){
        try {
            $b=Banners::where('is_active',1)->orderBy('order', 'asc')->get();
            $this->page['banners'] = $b->map(function($e){
                $e->link=$this->mediaPath().$e->image_path;
                return $e;
            });
        } catch (\Exception $e) {
            trace_log('Error in BannerSliderComponent: ' . $e->getMessage());
            $this->page['bannerSliderError'] = $e->getMessage();
        }
    }
}
