var $searchInput;

$(document).ready(function() {
    $searchInput = $('#Search input[name="q"]');
    $resultsBox = $('#searchResults');
});


function doSearch(q) {


    clearSearch(q);

    if ($searchInput.val() != q) {
    //    displayResults(lastResult);

    }

    execSearch(q, setHistory);
}


function execSearch(q) {



    $.ajax({
        url: '/ajax/search.php?q=' + q,
        async: true,
        dataType: 'json',
        success: function(data){
            lastResult = data;
            if (data.length > 0) {
	            displayResults(data);
            } else {
                noResults();
            }

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(
                "The following error occured: "+
                textStatus, errorThrown
            );
        }
    });

}

var lastResult;
var timer;
var oldTileState;
var firstUpdate = false;

$(window).load(function() {

    $searchInput.click(function() {
        if ($searchInput.val() != '') {
            clearSearch('');
            execSearch($searchInput.val());
        } else {
            clearSearch('');
        }
    });

    $searchInput.keyup(function () {

        var q = $searchInput.val();


        clearSearch(q);

        if (timer) {
	        clearTimeout(timer);
        }

        timer = setTimeout(function () {
            execSearch(q);
        }, 400);
    });

    $searchInput.click(function() {
       $(this).select();
    });

});


function noResults() {
    var q = $searchInput.val();
    if (q === "") {
        return;
    }
    $resultsBox.html('<div class="resultMessage">No Results for '  + q + '</div>');

}

function displayResults(data) {
    var out = "";
    for (var i = 0; i < data.length; i++) {
        out += '<a href="' + data[i]['path'] + '">';
        out += '<div class="searchResult">';
        out += '<div class="searchTitle">';
        out += data[i]['title'];
        out += '</div>';
        out += '<div class="searchDescription">';
        out += data[i]['content'];
        out += '</div>';
        out += '</div>';
        out += '</a>';
    }
    $resultsBox.hide().html(out).slideDown();

}

function clearSearch(q) {
    $resultsBox.show();
    if (q == '') {
        $resultsBox.html('<div class="resultMessage">Search docs, quizzes, and tutorials</div>');
    } else {
        $resultsBox.html('<div class="resultMessage">Searching: '  + q + '</div>');
    }

}

$(document).mouseup(function (e) {
    if (!$resultsBox.is(e.target) && $resultsBox.has(e.target).length === 0) {
        $resultsBox.slideUp('fast');
    }
});
