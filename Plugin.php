<?php namespace SunLab\UpDown;

use System\Classes\PluginBase;
use Winter\User\Models\User;

/**
 * UpDown Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = ['Winter.User'];

    public function pluginDetails()
    {
        return [
            'name'        => 'sunlab.updown::lang.plugin.name',
            'description' => 'sunlab.updown::lang.plugin.description',
            'author'      => 'SunLab',
            'icon'        => 'icon-arrows-v'
        ];
    }

    public function boot()
    {
        User::extend(static function ($user) {
            $user->hasMany['sunlab_updown_votes'] = [\SunLab\UpDown\Models\Vote::class];

            $user->addDynamicMethod('voteFor', static function ($votable) use ($user) {
                $vote =
                    $user->sunlab_updown_votes()
                         ->firstWhere([
                             'votable_type' => get_class($votable),
                             'votable_id' => $votable->id
                         ]);

                return $vote ?? false;
            });
        });
    }

    public function registerComponents()
    {
        return [
            \SunLab\UpDown\Components\UpDown::class => 'upDown'
        ];
    }
}
