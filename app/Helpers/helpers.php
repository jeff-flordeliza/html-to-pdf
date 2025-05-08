<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\Browsershot\Browsershot;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Response;

if (!function_exists('jprint')) {
    function jprint($param, $die = true)
    {
        echo '<pre>';
        print_r($param);
        echo '</pre>';

        if ($die)
            die;
    }
}

if (!function_exists('image_to_svg')) {
    function image_to_svg($imagePath)
    {
        if (!$imagePath)
            return;

        $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
    }
}

if (!function_exists('test_pdf')) {
    function test_pdf()
    {
        try {
            $file = new Filesystem;
            $file->cleanDirectory(storage_path('/pdfs'));

            $time = strtotime(now());
            $filename = sprintf("Test%s.pdf", $time);
            $path = sprintf("pdfs/%s", $time);

            $storage_path = storage_path("/$path");
            File::ensureDirectoryExists($storage_path);

            if (!File::exists("$storage_path/$filename")) {
                Browsershot::url('https://www.google.com')
                    ->setIncludePath('$PATH:/usr/bin')
                    ->noSandbox()
                    ->format('A4')
                    ->save("$storage_path/$filename");
            }
            return response()->download("$storage_path/$filename");
        } catch (\Throwable $th) {
            echo $th->getMessage();
            dd($th->getMessage());
        }
    }
}

if (!function_exists('generate_pdf')) {
    function generate_pdf()
    {
        try {
            $file = new Filesystem;
            $file->cleanDirectory(storage_path('/pdfs'));

            $time = strtotime(now());
            $filename = sprintf("Test%s.pdf", $time);
            $path = sprintf("pdfs/%s", $time);

            $storage_path = storage_path("/$path");
            File::ensureDirectoryExists($storage_path);

            if (!File::exists("$storage_path/$filename")) {
                $pdf = blind_cv_template(request());
                $pdf->save("$storage_path/$filename");
            }
            return response()->download("$storage_path/$filename");
        } catch (\Throwable $th) {
            echo $th->getMessage();
            dd($th->getMessage());
        }
    }
}

if (!function_exists('blind_cv_template')) {
    function blind_cv_template(Request $request)
    {
        $applicant = json_decode(json_encode($request->all()));
        $imagePath = public_path('assets/images/logo.png');
        $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
        $imageData = file_get_contents($imagePath);
        $logo = 'data:image/' . $imageType . ';base64,' . base64_encode($imageData);

        $html = view('pdfs.blind-cv', compact('applicant', 'logo'))->render();
        $header = view('pdfs.components.header')->render();
        $footer = view('pdfs.components.footer')->render();

        return Browsershot::html($html)
            ->setIncludePath('$PATH:/usr/bin')
            ->timeout(300)
            // ->setIncludePath('$PATH:/var/www/.nvm/versions/node/22/bin')
            ->format('A4')
            ->margins(25, 10, 20, 10)
            ->showBrowserHeaderAndFooter()
            ->waitUntilNetworkIdle()
            ->writeOptionsToFile() // This is the method you need to call
            ->headerHtml($header)
            ->footerHtml($footer);
    }
};
