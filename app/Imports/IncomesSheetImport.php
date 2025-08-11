<?php

namespace App\Imports;

use App\Models\Income;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class IncomesSheetImport implements ToModel, WithBatchInserts, WithChunkReading, WithStartRow
{

    protected $store_id;
    protected $batch;

    /**
     * OrdersImport constructor.
     *
     * @param int $store_id
     * @param int $batch
     */
    public function __construct($store_id, $batch = 1)
    {
        $this->store_id = $store_id;
        $this->batch = $batch;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Income([
            'code' => $row[1], // 0
            'total' => $this->convertStringToInteger($row[29]), // 0
            'date' => $row[6], // 48
            'store_id' => $this->store_id, // 48
            'batch' => $this->batch, // 48
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function startRow(): int
    {
        return 7;
    }

    protected function convertStringToInteger($value)
    {
        $money = preg_replace('/[^0-9]/', '', $value);

        return (int) $money;
    }
}
