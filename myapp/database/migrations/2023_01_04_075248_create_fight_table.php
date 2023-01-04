<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    # up 부분에는 데이터베이스에 새 테이블, 열, 인덱스를 추가하는데 사용됨  --> php artisan migrate 칠 때 실행
    # create 메소드가 실행되며 첫 번째 인수로 테이블명 받고, 두 번째 인수는 콜백 콜백에선 $tables이란 blueprint 인스턴스를 받는다.
    # tables을 이용하여 필드들을 정의 string,text등 다양하게 정의 할 수 있는 메소드가 있음

    # 데이터베이스에 연동하여 사용하는 듯 함
    # CRT에서 php artisan migrate 사용하면 ->> up function안에 있는 함수 생성됨
    # 반대로 php artisan migrate:rollback 하면 ->> function 안에 있는 함수 실행됨
    # migrate:rollbakc = 직전 마이그레이션만 롤백
    # migrate:reset = 모든 마이그레이션 롤백하고 데이터베이스 초기화
    # migrate:refresh = 리셋 실행해서 데이터베이스 청소한 후 마이그레이션 처음부터 다시실행

    public function up()
    {
        Schema::create('fightaaa', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    # up 부분과는 반대 php artisan migrate:rollback 칠 때 실행
    public function down()
    {
        Schema::dropIfExists('fightaaa');
    }
};
