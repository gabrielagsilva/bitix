$(document).ready(function(){
    $('.add').on('click', function () {
        $('#beneficiarios').append('<div class="beneficiario">\
        <label>Nome:</label> <input type="text" name="beneficiario[nome][]" required>\
        <label>Idade:</label> <input type="number" name="beneficiario[idade][]" required><br>\
        <input type="button" class="delete" value="Remover">\
        </div>');
    });
});

$(document).on("click",".delete",function(){
    $(this).parent().remove();
});

// planos
$(window).on('load', function(){
    $.ajaxSetup({
        async: false
    });
    
    var JSONItems = [];
    $.getJSON( "json/planos.json", function( data){
        JSONItems = data;
    });

    var src = $.map(JSONItems, function(item) {
        
        return {
                label:item.registro,
                value:item.nome,
                codigo:item.codigo	   
        }
     
    });
    
    $('#registro').autocomplete({
        source: function(request, response) {
            var results = $.ui.autocomplete.filter(src, request.term);

            if (!results.length) {
                results = ["Sem resultados."];
            }

            response(results);
        },
        select: function (event, ui) {
            if (ui.item.label === "Sem resultados.") {
                event.preventDefault();
            }
            else {
                this.value = ui.item.label;
                $('#plano').val(ui.item.value);
                $('#codigo').val(ui.item.codigo);
            }
        }
    });

    $('#registro').on('keydown', function() {
        if ($(this).val().length > 0) {
            $('#plano').val('');
            $('#codigo').val('');
        }
    });
});