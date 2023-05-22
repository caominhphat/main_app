<?php

namespace App\Jobs;

use App\libs\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Util\Exception;

class uploadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected $originalName , protected $fileName, protected $item, protected $table)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(Storage::disk("local")->exists($this->fileName)) {
            $content = Storage::disk("local")
                ->get($this->fileName);
            Storage::disk("local")->delete($this->fileName);
            Storage::disk('google')->put($this->fileName, $content);
            $this->item->documents()->create([
                'url' => $this->fileName,
                'name' => $this->originalName
            ]);
            Helper::clearCache($this->table);
        }
        Log::info('Upload file '.$this->originalName.' success');
    }
}
