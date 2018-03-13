<?php

namespace App\Jobs;

use App\ImportItem;
use App\Services\UploadToDatabase;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProccessGame implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $game;
    protected $item;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($game, $item)
    {
        $this->game = $game;
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UploadToDatabase $upload)
    {
        $error = $upload->validate($this->game);
        if ($error !== null) {
            $this->item->update(['status' => ImportItem::FAIL, 'error_message' => $error]);
            return;
        }

        $this->item->update(['status' => ImportItem::IN_PROGRESS]);
        $game = $upload->upload($this->game);
        if ($game !==null) {
            $this->item->update(['status' => ImportItem::DONE, 'product_id' => $game->id, 'product_name' => $game->name]);
        } else {
            $this->item->update(['status' => ImportItem::FAIL]);
        }
    }

    public function failed()
    {
        $this->item->update(['status' => ImportItem::FAIL]);
    }
}
