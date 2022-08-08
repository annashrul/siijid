
function goPrint(tipe,data_, reprint) {
    var data = {
        app: tipe,
        print: {
            konektor: "usb",
            vid: vid,
            pid: pid,
            server: "127.0.0.1",
            // t1:getNotaZakat("MASJID GRIYA BANDUNG INDAH","ZAKAT","TRX0000","2019-08-12","Dayus","Kas Masuk",15000),
            // t1: tipe === "test" ? "tes" : (tipe == "pos" ? getNotaMaster(data,reprint) : (tipe == "kas" ? getNotaKas(data) : getNotaClosing(data))),
            t1: tipe === "kas" ? getNotaZakat(data_):null,
            total: "",
            reprint: reprint
        },
        headfoot: {
            "header1": "",
            "header2": "",
            "header3": "Bandung",
            "header4": "-",
            "footer1": "Test Cafe",
            "footer2": "-",
            "footer3": "-",
            "footer4": "-"
        }
    };
    console.log(data.headfoot);
    console.log(data.print.t1);
    socket.emit('print', JSON.parse(JSON.stringify(data)));
}

function getNotaZakat(data/*title,sub_title,kd_trx,tgl,kd_kasir,jenis_kas,jumlah*/) {
    var kas = '';
    kas += newLine;
    kas += data.title;
    kas += newLine;
    kas += data.sub_title;
    kas += newLine;
    kas += line(page_size);
    kas += newLine;
    kas += "Kode Trx " + titikdua + data.kd_zakat;
    kas += newLine;
    kas += "Tanggal  " + titikdua + data.tanggal;
    kas += newLine;
    kas += "Nama     " + titikdua + data.nama;
    kas += newLine;
    kas += "Jenis    " + titikdua + data.jenis;
    kas += newLine;
    kas += "Bentuk   " + titikdua + data.bentuk;
    kas += newLine;
    kas += "Jiwa     " + titikdua + data.jiwa;
	kas += newLine;
    kas += "Total    " + titikdua + data.total;
    kas += newLine;
    kas += line(page_size);
    kas += newLine + newLine;
    return kas;
}

function line(page_size) {
    var line = '';
    for (var i = 0; i < page_size; i++) {
        line += "=";
    }
    return line;
}

function toMoney(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
