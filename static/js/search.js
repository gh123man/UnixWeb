var $searchInput;

$(document).ready(function() {
    $searchInput = $('#Search input[name="q"]');
    $resultsBox = $('#searchResults');
});


function doSearch(q) {


    clearSearch(q);

    if ($searchInput.val() != q) {
        $searchInput.val(q);
    }

    execSearch(q, setHistory);
}


function execSearch(q) {

    if (q != lastValue) {

        if (q === '') {
            updatePath();
        }

        $.ajax({
            url: '/ajax/search.php?q=' + q,
            async: true,
            dataType: 'json',
            success: function(data){

                if (data.length > 0) {
                    lastResult = data.last;
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

        lastValue = q;
    }
}

var lastValue;
var lastResult;
var timer;
var oldTileState;
var firstUpdate = false;

var lastQ = "";
$(window).load(function() {

    $searchInput.click(function() {
        clearSearch('')
    });

    $searchInput.keyup(function () {

        var q = $searchInput.val();

        if (lastQ === q && q === "") {
            return;
        } else if (q === "") {
            lastQ = q;
            return;
        }

        clearSearch(q);

        if (timer) {
	        clearTimeout(timer);
        }

        lastQ = q;

        timer = setTimeout(function () {
            execSearch(q);
        }, 300);
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
    $resultsBox.html(out);

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
        $resultsBox.hide();
    }
});
