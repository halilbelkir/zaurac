$(document).ready(function ()
{
    setTimeout(function()
    {
        $('select[name="data-tables_length"]').attr('class','border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm pl-4 pr-0 text-sm');
        $('select[name="data-tables_length"]').attr('style','margin-bottom:10px');
        $('input[aria-controls="data-tables"]').attr('class','border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm');
        $( ".sortable tbody" ).sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sortable('sortable');
            }
        });
    }, 300);

});

/////////// seflink ///////////


function seflink1(ad,yazilacakyer)
{
    str = turkcekarekteryoket(ad,yazilacakyer);
    str = str.toLowerCase();
    str = str.replace(/\s\s+/g,' ').replace(/[^a-z0-9\s]/gi,',').replace(/[^\w]/ig,"-");
    turkcekarekteryoket(str,yazilacakyer);
}

function turkcekarekteryoket(gelenler,yazilacakyer)
{
    var specialChars = [["Ã…Å¸","s"],["Ã…Â","s"],["Ã„Å¸","g"],["Ã„Â","g"],["ÃƒÂ¼","u"],["ÃƒÅ“","u"],["Ã„Â°","i"],["Ã„Â±","i"],["_","-"],["Ãƒâ€“","o"],["ÃƒÂ¶","o"],["Ãƒâ€¦Ã‚Â","S"],["Ãƒâ€Ã‚Â","G"],["ÃƒÆ’Ã¢â‚¬Â¡","C"],["Ãƒâ€¡","c"],["ÃƒÂ§","c"],["ÃƒÆ’Ã…â€œ","U"],["Ãƒâ€Ã‚Â°","I"],["ÃƒÆ’Ã¢â‚¬â€œ","O"],["Ãƒâ€¦Ã…Â¸","s"],["ç","c"],["Ç","c"],["ş","s"],["Ş","s"],["İ","i"],["I","i"],["ı","i"],["Ü","u"],["ü","u"]];

    for(var i=0;i<specialChars.length;i++)
    {
        gelenler=gelenler.replace(eval("/"+specialChars[i][0]+"/ig"),specialChars[i][1]);
        $(yazilacakyer).val(gelenler);
    }
    return gelenler;
}

/////////// seflink ///////////

function sortable(class_adi)
{
    var order = [];
    var token = $('meta[name="csrf-token"]').attr('content');

    $('.'+class_adi+' tbody tr').each(function(index,element) {
        order.push({
            id: $('.'+class_adi+' tbody tr:eq('+index+') td a[data-id]').attr('data-id'),
            position: index+1
        });

        console.log(order);
    });

    $.ajax({
        type: "POST",
        dataType: "json",
        url: $('.'+class_adi).attr('data-link'),
        data: {
            order: order,
            _token: token
        },
        success: function(response) {
            if (response.result == 1)
            {
                $('.'+class_adi+' tbody tr').each(function(index,element) {
                    $('.'+class_adi+' tbody tr:eq('+index+') td:eq(0)').text(index+1);
                });
            }
        }
    });
}


