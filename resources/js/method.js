export const methods = {
    async changeFilterForm(param=''){
        if (!Alpine.store('dataTable').data.provinsi_id) {
            Alpine.store('dataTable').data.kabupaten_id = '' 
        }

        if (Alpine.store('dataTable').data.provinsi_id && typeof param == "string") {
            await axios.get(Alpine.store('dataTable').kabupatenUrl, { params: { provinsi:  param} }).then(response => {
                Alpine.store('dataTable').kabupatensForm = response.data.data
                Alpine.store('dataTable').data.kabupaten_id = '' 
            })
        }
        
    },
    async changeFilter(param=''){
        if (!Alpine.store('dataTable').provinsi) {
            Alpine.store('dataTable').kabupaten = '' 
        }

        if (Alpine.store('dataTable').provinsi && typeof param == "string") {
            await axios.get(Alpine.store('dataTable').kabupatenUrl, { params: { provinsi:  param} }).then(response => {
                Alpine.store('dataTable').kabupatens = response.data.data
                Alpine.store('dataTable').kabupaten = '' 
            })
        }

        Alpine.store('dataTable').table.ajax.url(Alpine.store('dataTable').apiUrl + (Alpine.store('dataTable').provinsi ? `?provinsi=${Alpine.store('dataTable').provinsi}` : '')+(Alpine.store('dataTable').kabupaten ? `&kabupaten=${Alpine.store('dataTable').kabupaten}` : '')).load()
        
    },
    addData(){
        Alpine.store('dataTable').actionUrl = Alpine.store('dataTable').store
        Alpine.store('dataTable').data = {
            name: ''
        }
        Alpine.store('dataTable').editStatus = false
    },
    editData(event, val){
        Alpine.store('dataTable').editStatus = true
        Alpine.store('dataTable').data = {...Alpine.store('dataTable').datas.filter(el => el.id == val)[0]};
        Alpine.store('dataTable').actionUrl = `${Alpine.store('dataTable').url}/${Alpine.store('dataTable').data.id}`
        $('#modal-default').modal();
    },
    deleteData(event,id){
        Alpine.store('dataTable').actionUrl = `${Alpine.store('dataTable').url}/${id}`
        if (confirm('Are you sure ?')) {
        axios.post(Alpine.store('dataTable').actionUrl, {_method : 'DELETE'}).then(response => {
            alert('Data has been removed')
            Alpine.store('dataTable').table.ajax.reload()
        })
        }
    },
    submitForm(event){
        event.preventDefault();
        Alpine.store('dataTable').loading = true;
        axios.post(Alpine.store('dataTable').actionUrl, new FormData($(event.target)[0])).then( response => {
            Alpine.store('dataTable').provinsi = ''
            Alpine.store('dataTable').kabupaten = ''
            setTimeout(() => {
                Alpine.store('dataTable').table.ajax.reload()
            }, 500);
            Alpine.store('dataTable').loading = false
            $('#modal-default').modal('hide')
        })
    }
}

window.methods = methods;