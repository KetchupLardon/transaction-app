jQuery(document).ready(($) => {

    const flitersList = ["category", "payment_method", "date", "type"];
    
    const loadAllData = (page = 1,category = "", payment_method = "", type = "", date ="") => {
        $.ajax({
            url: "http://localhost/www/transaction/src/API/ajax.php",
            method:"POST",
            data: {page:page, category:category, payment_method:payment_method, type:type, date:date},
            success: (data) => {
                $('#transaction_list').html(data);
            }
        });
    }

    const getInputValues = () => {
        const type = $('input[name=type]:checked').val();
        const category = $('#category').children("option:selected").val();
        const payment_method = $('#payment_method').children("option:selected").val();
        const date = $('#date').children("option:selected").val();
        return {
            type: type,
            category: category,
            payment_method: payment_method,
            date: date
        }
    }

    const createActiveFilterButton = (filter, content) => {
        if(!$(`#active_${filter}`).length){
            $(`#js_${filter}_filter`).append(`<div id="active_${filter}" class="flex_row active_button"><div>${content}</div><div>x</div></div>`);
        } else {
            $(`#active_${filter}`).text(content);
        }
    }

    const loadFilteredData = (page = 1) => {
        const categoryContent = $('#category').children("option:selected").text();
        const payment_methodContent = $('#payment_method').children("option:selected").text();
        const dateContent = $('#date').children("option:selected").text();
        const typeContent = $('input[name=type]:checked').parent().text();
        const data_list = getInputValues();
        loadAllData(page, data_list.category, data_list.payment_method, data_list.type, data_list.date);
        if(data_list.category) createActiveFilterButton(flitersList[0], categoryContent);
        if(data_list.payment_method) createActiveFilterButton(flitersList[1], payment_methodContent);
        if(data_list.date) createActiveFilterButton(flitersList[2], dateContent);
        if(data_list.type) createActiveFilterButton(flitersList[3], typeContent);
    }

    loadAllData();

    $("select.js_filter").change(() => loadFilteredData());
    $("input[type=radio][name=type].js_filter").change(() => loadFilteredData());
    $('body').on('click', '.pagination_link', (event) => {
        const page = $(event.target).text();
        loadFilteredData(page);
    });

    //delete active filter on click
    flitersList.map(filter => {
        $(`#js_${filter}_filter`).click(() => {
            if($(`#active_${filter}`).length){
                $(`#active_${filter}`).remove();
                if(filter === "type"){
                    $('input[name=type]:checked').prop('checked', false);
                } else {
                    $(`#${filter}`).val("");
                }
                loadFilteredData();
            }
        });
    })
});