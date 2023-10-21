import { methods } from "./method.js";

const addState = {    
        url : url||'',
        store : store||'',
        apiUrl : apiUrl||'',
        actionUrl : apiUrl||'',
        kabupatenUrl: kabupatenUrl||'',
        columns : columns||[],
        ...methods
}

export const alpine = () => Alpine.store('dataTable', {
    async init() {
        await this.dataTable();
    },
    loading:false,
    data: {},
    datas: [],
    total_penduduk: 0,
    total_provinsi: 0,
    total_kabupaten: 0,
    provinsi: '',
    kabupaten: '',
    kabupatens: [],
    kabupatensForm: [],
    editStatus: false,
    ...addState,
    dataTable(){
        const _this = this
        _this.table =  $('#datatable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        ajax: {
                            url:  _this.apiUrl,
                            error: function (xhr, error, thrown) {
                                console.log('Kesalahan AJAX:', error);
                                console.log('Detail Kesalahan:', thrown);
                                // Tindakan yang sesuai, misalnya menampilkan pesan kesalahan kepada pengguna
                            }
                        },
                        columns:  _this.columns
                        }).on('xhr', function () {
                        console.log(_this.table.ajax.json().data);
                        _this.datas = _this.table.ajax.json().data;
                        _this.totalData($("input.form-control-sm")[0].value, _this.provinsi, _this.kabupaten )
                        })
    },
    totalData(search="", provinsi="", kabupaten=""){
        axios.get('api/penduduk/total', { params: { search: search, provinsi: provinsi, kabupaten: kabupaten} }).then(response => {
            console.log(response);
            this.total_penduduk = response.data.penduduk_total;
            this.total_provinsi = response.data.provinsi_total;
            this.total_kabupaten = response.data.kabupaten_total;
        })
    }
})