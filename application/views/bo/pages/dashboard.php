
<div class="row">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <label>Periode</label>
            <?php $field = 'field-date';?>
            <div id="daterange" style="cursor: pointer;">
                <div class="input-group">
                    <input type="text" name="periode" id="<?=$field?>" class="form-control" style="height: 40px;" value="<?=isset($this->session->search['periode'])?$this->session->search['periode']:(set_value('periode')?set_value('periode'):date("Y-m-d")." - ".date("Y-m-d"))?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>

        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <label for="">&nbsp;</label>
                <button type="button" class="btn btn-primary bg-blue" onclick="cari()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cari" style="margin-top: 25px;"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <canvas id="grafik_kas"  width="900" height="380"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        @media(max-width:767px){
                            #grafik_kas{
                                width: 100%;
                                height: auto;
                            }
                            #jumlah_uang{
                                width: 100%!important;
                                height: auto!important;
                            }
                            #jumlah_beras{
                                width: 100%!important;
                                height: auto!important;
                            }
                        }
                    </style>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs tabs">
                                <li class="active tab">
                                    <a href="#uang" data-toggle="tab" aria-expanded="false">
<!--                                        <span class="visible-xs"><i class="fa fa-bar-chart"></i></span>-->
                                        <span>Uang</span>
                                    </a>
                                </li>
                                <li class="tab">
                                    <a href="#beras" data-toggle="tab" aria-expanded="false">
<!--                                        <span class="visible-xs"><i class="fa fa-bar-chart"></i></span>-->
                                        <span>Beras</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="uang">
                                    <canvas id="jumlah_uang"  width="900" height="380"></canvas>
                                </div>
                                <div class="tab-pane" id="beras">
                                    <canvas id="jumlah_beras"  width="900" height="380"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var img = "<?=base_url('assets/')?>";   //** url images **//

    $(document).ready(function () {
        load_data();
        // cari()
    });

    function cari() {
        var periode = $("#field-date").val();
        // console.log(periode)
        load_data({periode: periode});
        // location.reload()
    }
    function load_data(data={}) {
        $.ajax({
            url: "<?=base_url().'welcome/get_dashboard/' ?>",
            type: "POST",
            dataType: "JSON",
            data:data,
            beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
            complete  : function() {$('.first-loader').remove()},
            success: function (res) {
                draw(res.report_kas.label, res.report_kas.data);
                draw1(res.report_zakat.label, res.report_zakat.data);
                draw2(res.report_zakat.label2, res.report_zakat.data2);

            }
        });
    }

    function after_change(val) {
        $.ajax({
            url: "<?php echo base_url().'welcome/set_session_date/' ?>" + btoa('field-date') + '/' + btoa(val),
            type: "GET"
        });
    }

    function draw(labels_, data_) {
        var grafik_kas = document.getElementById("grafik_kas");
        new Chart(grafik_kas, {
            type: 'line',
            data: {
                labels: labels_,
                datasets: [{
                    data: data_,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'SALDO AKHIR',
                    fontSize: 16
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[0].data[tooltipItem.index];
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);

                            value = value.join(',');
                            return value;
                        },
                        labelColor: function(tooltipItem, chart) {
                            return {
                                borderColor: 'rgba(255, 99, 132, 0.2)',
                                backgroundColor: 'rgba(255,99,132,1)'
                            }
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            userCallback: function(value, index, values) {
                                // Convert the number to a string and splite the string every 3 charaters from the end
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);

                                // Convert the array to a string and format the output
                                value = value.join(',');
                                return value;
                            }
                        }
                    }]
                }
            }
        });
    }


    function draw1(labels_, data_) {
        var jumlah_uang = document.getElementById("jumlah_uang");
        new Chart(jumlah_uang, {
            type:"bar",
            data: {
                labels:labels_,
                datasets:[ {
                    data:data_,
                    fill:false,
                    backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)","rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)","rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)"],
                    borderColor:["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)","rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)","rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)"],"borderWidth":1
                }]
                // datasets:[ {
                //     data:data_,
                //     backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                //     borderColor:["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                //     borderWidth:1
                // }]
            },
            options:{
                title: {
                    display: true,
                    text: "<?='GRAFIK ZAKAT MASJID '.$user['nama_masjid']?>",
                    fontSize: 16
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[0].data[tooltipItem.index];
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);

                            value = value.join(',');
                            return value;
                        }
                    }
                },
                scales:{
                    yAxes:[{
                        ticks:{
                            beginAtZero:true,
                            userCallback: function(value, index, values) {
                                // Convert the number to a string and splite the string every 3 charaters from the end
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);

                                // Convert the array to a string and format the output
                                value = value.join(',');
                                return value;
                            }
                        }
                    }],
                    xAxes: [{
                        ticks: {
                        }
                    }]
                }
            }
        });
    }
    function draw2(labels_, data_) {
        var jumlah_beras = document.getElementById("jumlah_beras");
        new Chart(jumlah_beras, {
            type:"bar",
            data: {
                labels:labels_,
                datasets:[ {
                    data:data_,
                    fill:false,
                    backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)","rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)","rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)"],
                    borderColor:["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)","rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)","rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)"],"borderWidth":1
                }]},
            options:{
                title: {
                    display: true,
                    text: "<?='GRAFIK ZAKAT MASJID '.$user['nama_masjid']?>",
                    fontSize: 16
                },
                legend: {
                    display: false
                },
                scales:{
                    xAxes:[{
                        ticks:{
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }

</script>

