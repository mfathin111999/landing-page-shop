<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class OrdersImport implements ToModel, WithStartRow, WithBatchInserts, WithChunkReading
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
        return new Order([
            'code' => $row[0],
            'sku' => $row[12] ?? null,
            'sku_ref' => $row[14] ?? null,
            'variant' => $row[15],
            'quantity' => $row[18],
            'city' => $row[46],
            'province' => $row[47],
            'total' => $this->convertStringToInteger($row[20]),
            'date_ordered' => $row[8],
            'date_finished' => $row[48],
            'date_finished' => $row[48],
            'store_id' => $this->store_id,
            'batch' => $this->batch,
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
        return 2;
    }

    protected function convertStringToInteger($value)
    {
        $money = preg_replace('/[^0-9]/', '', $value);

        return (int) $money;
    }
}
