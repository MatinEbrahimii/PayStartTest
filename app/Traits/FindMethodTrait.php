<?php


namespace App\Traits;


use App\Http\Response\IResponse;
use App\Http\Response\StatusCodes;
use Imanghafoori\Helpers\Nullable;

trait FindMethodTrait
{
    public static function findOr($id)
    {
        $model = self::find($id);

        return new Nullable($model);
    }

    public static function findOrNotFound($id)
    {
        return self::findOr($id)->getOrSend(function () {
            return app(IResponse::class)->send(StatusCodes::NOT_FOUND);
        });
    }
}
