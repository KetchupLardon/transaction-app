jQuery(document).ready(($) => {
    const getInputValues = () => {
        const type = $('input[name=type]:checked').val();
        const category = $('#category').children("option:selected").val();
        const payment_method = $('#payment_method').children("option:selected").val();
        const date = $('#date').val();
        const amount = $('#amount').val();
        return {
            type: type,
            category: category,
            payment_method: payment_method,
            date: date,
            amount: amount
        }
    }

    const validForm = (e) => {
        const red = "#F57D90";
        const green = "#6FCF97";
        const inputDatas = getInputValues();
        console.log(inputDatas.category, inputDatas.payment_method, inputDatas.type, inputDatas.date, inputDatas.amount);
        if(inputDatas.category && inputDatas.payment_method && inputDatas.type && inputDatas.date && inputDatas.amount){
            return;
        } else {
            inputDatas.amount ? $('.amount_label').css('color', green) : $('.amount_label').css('color', red);
            inputDatas.date ? $('.date_label').css('color', green) : $('.date_label').css('color', red);
            inputDatas.category ? $('.category_label').css('color', green) : $('.category_label').css('color', red);
            inputDatas.payment_method ? $('.payment_method_label').css('color', green) : $('.payment_method_label').css('color', red);
            inputDatas.type ? $('.type_label').css('color', green) : $('.type_label').css('color', red);
            e.preventDefault();
        }
    }
    $('#add_form').submit((e) => validForm(e));
    $('#edit_form').submit((e) => validForm(e));
});