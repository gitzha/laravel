<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserAwards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getUserAward';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取上周用户积分增长量最大的十个用户';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //每周一统计上一周用户积分增长最大的前十个用户写入日志中
        //查询积分流水表 时间当前时间的上周，groupby uid sum（积分变化值） desc 取十条
        $this->info('开始执行...');
        $data = DB::table('award_streams')
            ->whereRaw("YEARWEEK( DATE_FORMAT( created_at, '%Y-%m-%d' ), 1 ) = YEARWEEK( NOW( ), 1 ) - 1")
            ->select(DB::raw('uid,sum(change_num) as total_change_num'))
            ->groupBy('uid')
            ->orderByDesc('total_change_num')
            ->limit(10)
            ->get();
        Log::info('上周用户积分增长最大的十个用户',[$data]);
        $this->info('执行结束...');
    }
}
