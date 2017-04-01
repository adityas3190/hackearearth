@extends('layouts.master')
@section('content')
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter King's name" class="form-control">
    <br>
    <div class="table-responsive">
    <table class="table table-striped" id="tableSearch">
        <thead>
            <tr>
                <th>Battle#</th>
                <th>Year</th>
                <th>Attacker</th>
                <th>Defender</th>
                <th>Won By</th>
                <th>Attacker Size</th>
                <th>Defernder Size</th>
                <th>Location</th>
                <th>Region</th>
            </tr>
        </thead>
        <tbody id="myTable" style="font-weight: 500">
        @foreach($results as $result)
            <tr>
                <td>{{ $result->battle_number }}</td>
                <td>{{ $result->year }}</td>
                <td>{{ $result->attacker_king }}</td>
                <td>{{ $result->defender_king }}</td>
                <td>
                    <?php $winner = $result->attacker_win == 0?$result->attacker_king:$defender_king  ?>
                    {{ $winner }}
                </td>
                <td>{{ $result->attacker_size }}</td>
                <td>{{ $result->defender_size }}</td>
                <td>{{ $result->location }}</td>
                <td>{{ $result->region }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12 text-center">
        <ul class="pagination pagination-lg pager" id="myPager"></ul>
    </div>
@endsection
@section('script')
    <script>

        $.fn.pageMe = function(opts){
            var $this = this,
                    defaults = {
                        perPage: 7,
                        showPrevNext: false,
                        hidePageNumbers: false
                    },
                    settings = $.extend(defaults, opts);

            var listElement = $this;
            var perPage = settings.perPage;
            var children = listElement.children();
            var pager = $('.pager');

            if (typeof settings.childSelector!="undefined") {
                children = listElement.find(settings.childSelector);
            }

            if (typeof settings.pagerSelector!="undefined") {
                pager = $(settings.pagerSelector);
            }

            var numItems = children.length;
            var numPages = Math.ceil(numItems/perPage);

            pager.data("curr",0);

            if (settings.showPrevNext){
                $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
            }

            var curr = 0;
            while(numPages > curr && (settings.hidePageNumbers==false)){
                $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
                curr++;
            }

            if (settings.showPrevNext){
                $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
            }

            pager.find('.page_link:first').addClass('active');
            pager.find('.prev_link').hide();
            if (numPages<=1) {
                pager.find('.next_link').hide();
            }
            pager.children().eq(1).addClass("active");

            children.hide();
            children.slice(0, perPage).show();

            pager.find('li .page_link').click(function(){
                var clickedPage = $(this).html().valueOf()-1;
                goTo(clickedPage,perPage);
                return false;
            });
            pager.find('li .prev_link').click(function(){
                previous();
                return false;
            });
            pager.find('li .next_link').click(function(){
                next();
                return false;
            });

            function previous(){
                var goToPage = parseInt(pager.data("curr")) - 1;
                goTo(goToPage);
            }

            function next(){
                goToPage = parseInt(pager.data("curr")) + 1;
                goTo(goToPage);
            }

            function goTo(page){
                var startAt = page * perPage,
                        endOn = startAt + perPage;

                children.css('display','none').slice(startAt, endOn).show();

                if (page>=1) {
                    pager.find('.prev_link').show();
                }
                else {
                    pager.find('.prev_link').hide();
                }

                if (page<(numPages-1)) {
                    pager.find('.next_link').show();
                }
                else {
                    pager.find('.next_link').hide();
                }

                pager.data("curr",page);
                pager.children().removeClass("active");
                pager.children().eq(page+1).addClass("active");

            }
        };

        $(document).ready(function(){

            $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:8});

        });
        function myFunction() {

            var input, filter, table, tr, td, i,td1;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableSearch");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                td1 = tr[i].getElementsByTagName("td")[3];
                if (td || td1) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }


            }
        }
    </script>
@endsection