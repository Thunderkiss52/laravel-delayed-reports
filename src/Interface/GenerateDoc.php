<?php
namespace Thunderkiss52\LaravelDelayedReport\Interface;

interface GenerateDoc {
    public static function rules(): array;
    public static function fields(): array;
    public static function filetype(): string;
    public static function label(): string;
    /**
     * Generate file
     * @param array $data
     * @return string|array path
     */

    public static function description(?array $data = []): string;
    public static function generate(array $data = []): string|array;
}