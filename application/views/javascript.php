<script>
    function NuevoCliente(Id) {

        $("#div-modal-generico").html("");

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>cliente/Ajax_nuevo",
            data: {Id: Id},
            cache: false,
            success: function (result) {

                $("#div-modal-generico").html(result);
            }
        });
    }

    function BuscarClientes() {

        $("#_tbodymodallista").html(""); 
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>cliente/Ajax_modal_busqueda",
            data: {Busqueda: $("#_buscadorpaciente").val()},
            cache: false,
            success: function (result) { 

                $("#_tbodymodallista").html(result);
            }
        });
    }

</script>

<script>
// sample calendar events data
    'use strict'
    var curYear = moment().format('YYYY');
    var curMonth = moment().format('MM');
// Calendar Event Source
    var azCalendarEvents = {
        id: 1,
        events: [{
                id: '2',
                start: curYear + '-' + curMonth + '-10T09:00:00',
                end: curYear + '-' + curMonth + '-10T17:00:00',
                title: 'Test X',
                backgroundColor: '#d5ffff',
                borderColor: '#00cccc',
                description: 'Test'
            },
        {
                id: '22',
                start: curYear + '-' + curMonth + '-11T09:00:00',
                end: curYear + '-' + curMonth + '-11T17:00:00',
                title: 'Test 2wwww',
                backgroundColor: '#d5ffff',
                borderColor: '#00cccc',
                description: 'Test 22222'
            } 
        ]
    };
// Birthday Events Source
    var azBirthdayEvents = {
        id: 2,
        backgroundColor: '#cbfbb0',
        borderColor: '#3bb001',
        events: [{
                id: '6',
                start: curYear + '-' + curMonth + '-10T15:00:00',
                end: curYear + '-' + curMonth + '-10T21:00:00',
                title: 'Martin',
                description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
            }]
    };
    var azHolidayEvents = {
        id: 3,
        backgroundColor: '#fbbfdc',
        borderColor: '#f10075',
        events: [{
                id: '8',
                start: curYear + '-' + curMonth + '-28',
                end: curYear + '-' + curMonth + '-29',
                title: 'Veteran\'s Day'
            }]
    };
    var azOtherEvents = {
        id: 4,
        backgroundColor: '#ffecca',
        borderColor: '#ffb52b',
        events: [{
                id: '13',
                start: curYear + '-' + curMonth + '-29',
                end: curYear + '-' + curMonth + '-31',
                title: 'My Rest Day'
            }]
    };
      var zaXX = {
        id: 5,
        backgroundColor: '#ffecca',
        borderColor: '#ffb52b',
        events: [{
                id: '11',
                start: curYear + '-' + curMonth + '-23',
                end: curYear + '-' + curMonth + '-23',
                title: 'My Rest Day'
            }]
    };


    $(function () {
        'use strict'

        // Datepicker found in left sidebar of the page
        var highlightedDays = [];
        var date = new Date();
        
        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function (date) {
                var m = date.getMonth(),
                        d = date.getDate(),
                        y = date.getFullYear();
                for (var i = 0; i < highlightedDays.length; i++) {
                    if ($.inArray(y + '-' + (m + 1) + '-' + d, highlightedDays) != -1) {
                        return [true, 'ui-date-highlighted', ''];
                    }
                }
                return [true];
            }
        });
        var generateTime = function (element) {
            var n = 0,
                    min = 30,
                    periods = [' AM', ' PM'],
                    times = [],
                    hours = [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
            for (var i = 0; i < hours.length; i++) {
                times.push(hours[i] + ':' + n + n + periods[0]);
                while (n < 60 - min) {
                    times.push(hours[i] + ':' + ((n += min) < 10 ? 'O' + n : n) + periods[0])
                }
                n = 0;
            }
            times = times.concat(times.slice(0).map(function (time) {
                return time.replace(periods[0], periods[1])
            }));
            //console.log(times);
            $.each(times, function (index, val) {
                $(element).append('<option value="' + val + '">' + val + '</option>');
            });
        }
        generateTime('.main-event-time');
        // Initialize fullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            navLinks: true,
            selectable: true,
            selectLongPressDelay: 100,
            editable: true,
            nowIndicator: true,
            defaultView: 'listMonth',
            views: {
                agenda: {
                    columnHeaderHtml: function (mom) {
                        return '<span>' + mom.format('ddd') + '</span>' + '<span>' + mom.format('DD') + '</span>';
                    }
                },
                day: {
                    columnHeader: false
                },
                listMonth: {
                    listDayFormat: 'ddd DD',
                    listDayAltFormat: false
                },
                listWeek: {
                    listDayFormat: 'ddd DD',
                    listDayAltFormat: false
                },
                agendaThreeDay: {
                    type: 'agenda',
                    duration: {
                        days: 3
                    },
                    titleFormat: 'MMMM YYYY'
                }
            },
            eventSources: [azCalendarEvents, azBirthdayEvents, azHolidayEvents, azOtherEvents,zaXX],
            eventAfterAllRender: function (view) {
                if (view.name === 'listMonth' || view.name === 'listWeek') {
                    var dates = view.el.find('.fc-list-heading-main');
                    dates.each(function () {
                        var text = $(this).text().split(' ');
                        var now = moment().format('DD');
                        $(this).html(text[0] + '<span>' + text[1] + '</span>');
                        if (now === text[1]) {
                            $(this).addClass('now');
                        }
                    });
                }
                console.log(view.el);
            },
            eventRender: function (event, element) {
                if (event.description) {
                    element.find('.fc-list-item-title').append('<span class="fc-desc">' + event.description + '</span>');
                    element.find('.fc-content').append('<span class="fc-desc">' + event.description + '</span>');
                }
                var eBorderColor = (event.source.borderColor) ? event.source.borderColor : event.borderColor;
                element.find('.fc-list-item-time').css({
                    color: eBorderColor,
                    borderColor: eBorderColor
                });
                element.find('.fc-list-item-title').css({
                    borderColor: eBorderColor
                });
                element.css('borderLeftColor', eBorderColor);
            },
        });
        var azCalendar = $('#calendar').fullCalendar('getCalendar');
        // change view to week when in tablet
        if (window.matchMedia('(min-width: 576px)').matches) {
            azCalendar.changeView('agendaWeek');
        }
        // change view to month when in desktop
        if (window.matchMedia('(min-width: 992px)').matches) {
            azCalendar.changeView('month');
        }
        // change view based in viewport width when resize is detected
        azCalendar.option('windowResize', function (view) {
            if (view.name === 'listWeek') {
                if (window.matchMedia('(min-width: 992px)').matches) {
                    azCalendar.changeView('month');
                } else {
                    azCalendar.changeView('listWeek');
                }
            }
        });
        // display current date
        var azDateNow = azCalendar.getDate();
        azCalendar.option('select', function (startDate, endDate) {
            
            //alert(startDate.format('LL') + " - " + endDate.format('LL') + " - " + startDate.format('LT') + " - " + endDate.format('LT') );
            $('#modal-generico').modal('show');
            NuevaCita(startDate.format('LL'));
            
           /* $('#mainEventStartDate').val(startDate.format('LL'));
            $('#EventEndDate').val(endDate.format('LL'));
            $('#mainEventStartTime').val(startDate.format('LT')).trigger('change');
            $('#EventEndTime').val(endDate.format('LT')).trigger('change');*/
            
            
        });
        // Display calendar event modal
        azCalendar.on('eventClick', function (calEvent, jsEvent, view) {
            
            alert(calEvent.id);
            
            
            var modal = $('#modalCalendarEvent'); 
            modal.modal('show');
            modal.find('.event-title').text(calEvent.title);
            if (calEvent.description) {
                modal.find('.event-desc').text(calEvent.description);
                modal.find('.event-desc').prev().removeClass('d-none');
            } else {
                modal.find('.event-desc').text('');
                modal.find('.event-desc').prev().addClass('d-none');
            }
            modal.find('.event-start-date').text(moment(calEvent.start).format('LLL'));
            modal.find('.event-end-date').text(moment(calEvent.end).format('LLL'));
            //styling
            modal.find('.modal-header').css('backgroundColor', (calEvent.source.borderColor) ? calEvent.source.borderColor : calEvent.borderColor);
            
            
        });
        // Enable/disable calendar events from displaying in calendar
        $('.main-nav-calendar-event a').on('click', function (e) {
            e.preventDefault();
            if ($(this).hasClass('exclude')) {
                $(this).removeClass('exclude');
                $(this).is(':first-child') ? azCalendar.addEventSource(azCalendarEvents) : '';
                $(this).is(':nth-child(2)') ? azCalendar.addEventSource(azBirthdayEvents) : '';
                $(this).is(':nth-child(3)') ? azCalendar.addEventSource(azHolidayEvents) : '';
                $(this).is(':nth-child(4)') ? azCalendar.addEventSource(azOtherEvents) : '';
            } else {
                $(this).addClass('exclude');
                $(this).is(':first-child') ? azCalendar.removeEventSource(1) : '';
                $(this).is(':nth-child(2)') ? azCalendar.removeEventSource(2) : '';
                $(this).is(':nth-child(3)') ? azCalendar.removeEventSource(3) : '';
                $(this).is(':nth-child(4)') ? azCalendar.removeEventSource(4) : '';
            }
            azCalendar.render();
            if (window.matchMedia('(max-width: 575px)').matches) {
                $('body').removeClass('main-content-left-show');
            }
        });

    })
</script>