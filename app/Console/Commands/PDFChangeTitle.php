<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PDFChangeTitle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:update-info {input} {output} {title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the info data in a PDF file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pdf_file_path = $this->argument('input');
        $metadata_file_path = $this->argument('output');

        $command = "pdftk {$pdf_file_path} dump_data output {$metadata_file_path}";

        exec($command);

        // $search = 'old_string';
        // $replace =  $this->argument('title');

        // $file = file_get_contents($metadata_file_path);
        // $file = str_replace($search, $replace, $file);
        // file_put_contents('pdf_metadata.txt', $file);

        $this->info('PDF info updated successfully!');
    }
}
