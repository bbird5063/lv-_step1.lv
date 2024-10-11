<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use Illuminate\Console\Command;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel; // вставил
use App\Imports\PostsImport; // вставил

class ImportExcelCommand extends Command
{
	protected $signature = 'import:excel'; // по этой команде вызывается метод handle() (было 'app:import-json-placeholder-command')

	protected $description = 'Get data from excel'; // то что в терминале справа белым текстом (было 'Command description')
	/**
	 * Теперь нашу команду в видно при 'php artisan':
	 * ...
	 *  import  
	 * 		import:excel      Get data from excel
	 * ...
	 * 
	 */

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		ini_set('memory_limit', '-1'); // отключил параметр лимит памяти
		Excel::import(new PostsImport(), public_path('excel/posts.xlsx'));
		dd('FINISH');
	}
}
