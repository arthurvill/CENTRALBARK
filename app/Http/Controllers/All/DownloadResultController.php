<?php

namespace App\Http\Controllers\All;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Support\MediaStream;

class DownloadResultController extends Controller
{
    public function __invoke(Result $result)
    {
        // Let's get some media.
        $downloads = $result->getMedia('booking_result_images');

        // Download the files associated with the media in a streamed way.
        // No prob if your files are very large.
        return MediaStream::create("$result->subject.zip")->addMedia($downloads);
    }
}