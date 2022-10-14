
function sortByField(field) {
    let type_inner = '';
    let params = new URLSearchParams(location.search);
    let currentType = params.get('sort_type');

    type_inner=currentType == 'asc' ? 'desc':'asc'
    params.set('sort_field', field);
    params.set('sort_type', type_inner);
    location.search = params.toString();
    console.log(params.toString());
}

