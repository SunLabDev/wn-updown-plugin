<?php namespace SunLab\UpDown\Behaviors;

use SunLab\UpDown\Models\Vote;

class Votable extends \Winter\Storm\Extension\ExtensionBase
{
    protected $parent;

    public function __construct($parent)
    {
        $this->parent = $parent;
        $this->parent->morphMany['sunlab_updown_votes'] = [Vote::class, 'name' => 'votable'];
    }

    public function getVotableModelAttribute()
    {
        return sprintf(
            '"votable_type": "%s", "votable_id": "%s"',
            addslashes(get_class($this->parent)),
            $this->parent->getKey()
        );
    }

    public function getVotableNoteAttribute()
    {
        return $this->parent->sunlab_updown_votes()->sum('vote') ?? 0;
    }
}
