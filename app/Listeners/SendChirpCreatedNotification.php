<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewChirp;
use App\Events\ChirpCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChirpCreatedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChirpCreated $event): void
    {
        $chirpCreator = User::find($event->chirp->user_id);

        // Obtener los seguidores del creador del Chirp
        $followers = $chirpCreator->followers()->get();

        // Enviar notificación solo a los seguidores
        foreach ($followers as $follower) {
            $follower->notify(new NewChirp($event->chirp));
        }
    }
}
