<script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }

            $(function () {

                <?php 
                    $data = array();
                    $id_produk = "";
                    $nama_produk = "";
                    $sell = 0;
                    for($i=0;$i<sizeof($salles);$i++){
                        $index = $salles[$i];
                        if(empty($id_produk)){
                            $id_produk = $index->id_produk;
                            $nama_produk = $index->nama_produk;
                            $sell = $sell + $index->penjualan;
                            if($i==sizeof($salles)-1){
                                $dataset = [
                                    'produk' => $nama_produk,
                                    'total' => $sell
                                ];
                                array_push($data, $dataset);
                            }
                        }else{
                            if(hash_equals($id_produk, $index->id_produk)){
                                $sell = $sell + $index->penjualan;
                                if($i==sizeof($salles)-1){
                                    $dataset = [
                                        'produk' => $nama_produk,
                                        'total' => $sell
                                    ];
                                    array_push($data, $dataset);
                                }
                            }else{
                                $dataset = [
                                    'produk' => $nama_produk,
                                    'total' => $sell
                                ];
                                array_push($data, $dataset);
                                $id_produk = $index->id_produk;
                                $nama_produk = $index->nama_produk;
                                $sell = $index->penjualan;
                                if($i==sizeof($salles)-1){
                                    $dataset = [
                                        'produk' => $nama_produk,
                                        'total' => $sell
                                    ];
                                    array_push($data, $dataset);
                                }
                            }
                        }
                    }
                ?>

                new Chart(document.getElementById("penjualan-chart"), {
                    type: 'bar',
                    data: {
                        labels: [
                            <?php 
                                for($i=0; $i<sizeof($data);$i++){
                                    echo "'".$data[$i]['produk']."'";
                                    if($i<sizeof($data) && $i!=sizeof($data)-1){
                                        echo ',';
                                    }
                                }
                            ?>
                        ],
                        datasets: [
                            {
                            label: "Terjual",
                            backgroundColor: [
                                <?php 
                                    for($i=0; $i<sizeof($data);$i++){
                                        switch($i){
                                            case 0:
                                                echo "'#6174d5'";
                                            break;
                                            case 1:
                                                echo "'#5f76e8'";
                                            break;
                                            case 2:
                                                echo "'#768bf4'";
                                            break;
                                            case 3:
                                                echo "'#7385df'";
                                            break;
                                            case 4:
                                                echo "'#b1bdfa'";
                                            break;
                                            case 5:
                                                echo "'#7385df'";
                                            break;
                                            default:
                                                echo "'#6174d5'";
                                            break;

                                        }
                                        if($i<sizeof($data) && $i!=sizeof($data)-1){
                                            echo ',';
                                        }
                                    }
                                ?>
                            ],
                            data: [
                                <?php 
                                    for($i=0; $i<sizeof($data);$i++){
                                        echo $data[$i]['total'];
                                        if($i<sizeof($data) && $i!=sizeof($data)-1){
                                            echo ',';
                                        }
                                    }
                                ?>
                            ]
                            }
                        ]
                    },
                    options: {
                        legend: { display: false },
                        title: {
                            display: true, 
                            text: 'Penjualan berdasarkan produk'
                        }
                    }
                });
            })
        </script>