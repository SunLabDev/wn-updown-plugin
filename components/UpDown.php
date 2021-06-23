<?php namespace SunLab\UpDown\Components;

use Cms\Classes\ComponentBase;
use Winter\User\Facades\Auth;

class UpDown extends ComponentBase
{
    public $votable;

    public function onUpVote()
    {
        $this->onAddVote(1);
    }

    public function onDownVote()
    {
        $this->onAddVote(-1);
    }

    protected function onAddVote(int $upOrDown)
    {
        $vote = $this->retrieveVoteFromPost();
        $vote->vote = $upOrDown;
        $vote->save();

        $this->votable = $vote->votable;
    }

    public function onRemoveVote()
    {
        $vote = $this->retrieveVoteFromPost();

        $this->votable = $vote->votable;

        $vote->delete();
    }

    protected function retrieveVoteFromPost()
    {
        $this->page['user'] = $user = Auth::getUser();

        $votableData = request()->only(['votable_type', 'votable_id']);

        return $user->sunlab_updown_votes()
                    ->firstOrNew($votableData);
    }

    public function componentDetails()
    {
        return [
            'name'        => 'sunlab.updown::lang.components.updown.name',
            'description' => 'sunlab.updown::lang.components.updown.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}
