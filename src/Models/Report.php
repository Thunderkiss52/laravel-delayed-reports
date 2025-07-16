<?php
namespace Thunderkiss52\LaravelDelayedReport\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Thunderkiss52\LaravelPermission\Attributes\HasPermission;
use Thunderkiss52\ModelTypes\Casts\ModelType;
use Thunderkiss52\ModelTypes\Traits\HasType;

#[HasPermission]
class Report extends Model implements HasMedia
{
    use HasType;
    use HasFactory;
    use InteractsWithMedia;
    
    protected string $typeSpace = 'report';
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
    public static string $label = 'Отчёт';
    protected $fillable = [
        'user_id',
        'payload',
        'execute_at',
        'email',
        'type',
    ];
    protected $casts = [
        'payload' => 'json',
        //'completed' => 'boolean',
        'type' => ModelType::class,
        'execute_at' => 'datetime'
    ];

    protected $appends = [
        'label',
        'filetype',
        'description'
    ];

    public function getLabelAttribute() {
        return $this->type::label();
    }

    public function getFiletypeAttribute() {
        return $this->type::filetype();
    }

    public function getDescriptionAttribute() {
        return $this->type::description($this->payload);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function execute(): void
    {
        $files = $this->type::generate();
        if(is_string($files)) {
            $files = [$files];
        }
        foreach ($files as $file) {
            $this->addMedia($file)->toMediaCollection('result');
        };
        $this->completed = 1;
        $this->save();
    }
}
