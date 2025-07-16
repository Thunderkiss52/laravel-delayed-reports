<?php
namespace Thunderkiss52\LaravelDelayedReport\Data;
use Thunderkiss52\LaravelForms\RelationData;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\Hidden;
use Spatie\LaravelData\Data;

class MediaData extends Data {
    #[Computed]
    readonly RelationData $user;
    public function __construct(
        #[Hidden]
        public mixed $id,//": 5,
        #[Hidden]
        public mixed $model_type,//": "App\\Models\\Report",
        #[Hidden]
        public mixed $model_id,//": 4,
        public mixed $uuid,//": "baa9404d-c3f3-4e5e-860e-c6dc231a058a",
        #[Hidden]
        public mixed $collection_name,//": "result",
        #[Hidden]
        public mixed $name,//": "table_compiled",

        public mixed $file_name,//": "table_compiled.xlsx",

        public mixed $mime_type,//": "application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        #[Hidden]
        public mixed $disk,//": "public",
        #[Hidden]
        public mixed $conversions_disk,//": "public",

        public mixed $size,//": 6110,
        #[Hidden]
        public mixed $manipulations,//": [],
        #[Hidden]
        public mixed $custom_properties,//": [],
        #[Hidden]
        public mixed $generated_conversions,//": [],
        #[Hidden]
        public mixed $responsive_images,//": [],
        #[Hidden]
        public mixed $order_column,//": 1,
        #[Hidden]
        public mixed $created_at,//": "2024-09-29T10:44:04.000000Z",
        #[Hidden]
        public mixed $updated_at,//": "2024-09-29T10:44:04.000000Z",
        #[Hidden]
        public mixed $original_url,//": "http:\/\/localhost\/storage\/5\/table_compiled.xlsx",
        #[Hidden]
        public mixed $preview_url,//": ""
    ){

}
}