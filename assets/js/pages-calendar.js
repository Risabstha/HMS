var Calendar = function() {
    "use strict";
    var dateToShow, calendar, demoCalendar, eventClass, eventCategory, subViewElement, subViewContent, $eventDetail;
    var defaultRange = new Object;
    defaultRange.start = moment();
    defaultRange.end = moment().add(1, 'days');

    // Calendar events setup
    var setFullCalendarEvents = function() {
        var date = new Date();
        dateToShow = date;
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        demoCalendar = [{
            title: 'Networking',
            start: new Date(y, m, d, 20, 0),
            end: new Date(y, m, d, 21, 0),
            className: 'event-job',
            category: 'job',
            allDay: false,
            content: 'Out to design conference'
        }, {
            title: 'Bootstrap Seminar',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2),
            className: 'event-off-site-work',
            category: 'off-site-work',
            allDay: true
        }, {
            title: 'Lunch with Nicole',
            start: new Date(y, m, d - 3, 12, 0),
            end: new Date(y, m, d - 3, 12, 30),
            className: 'event-generic',
            category: 'generic',
            allDay: false
        }, {
            title: 'Corporate Website Redesign',
            start: new Date(y, m, d + 5),
            end: new Date(y, m, d + 10),
            className: 'event-to-do',
            category: 'to-do',
            allDay: true
        }];
    };

    // Initialize FullCalendar
    var runFullCalendar = function() {
        $(".add-event").off().on("click", function() {
            eventInputDateHandler();
            $(".form-full-event #event-id").val("");
            $('.events-modal').modal();
        });
        
        $('.events-modal').on('hide.bs.modal', function(event) {
            $(".form-full-event #event-id").val("");
            $(".form-full-event #event-name").val("");
            $(".form-full-event #start-date-time").val("").data("DateTimePicker").destroy();
            $(".form-full-event #end-date-time").val("").data("DateTimePicker").destroy();
            $(".event-categories[value='job']").prop('checked', true);
        });

        $('#event-categories div.event-category').each(function() {
            var eventObject = {
                title: $.trim($(this).text())
            };
            $(this).data('eventObject', eventObject);
            $(this).draggable({
                zIndex: 999,
                revert: true,
                revertDuration: 50
            });
        });

        $('#full-calendar').fullCalendar({
            buttonIcons: {
                prev: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: demoCalendar,
            editable: true,
            eventLimit: true,
            droppable: true,
            dayRender: function(date, cell) {
                if (date.isBefore(moment(), 'day')) {
                    cell.addClass('fc-disabled');
                    cell.css('background-color', '#e9ecef');
                }
            },
            drop: function(date, allDay) {
                if (date.isBefore(moment())) {
                    alert("Cannot drop events on past dates.");
                    return;
                }

                var originalEventObject = $(this).data('eventObject');
                var $category = $(this).attr('data-class');

                var newEvent = new Object;
                newEvent.title = originalEventObject.title;
                newEvent.start = new Date(date);
                newEvent.end = moment(new Date(date)).add(1, 'hours');
                newEvent.allDay = true;
                newEvent.category = $category;
                newEvent.className = 'event-' + $category;

                $('#full-calendar').fullCalendar('renderEvent', newEvent, true);

                if ($('#drop-remove').is(':checked')) {
                    $(this).remove();
                }
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                if (start.isBefore(moment())) {
                    alert("Past dates cannot be selected.");
                    $('#full-calendar').fullCalendar('unselect');
                    return;
                }
                eventInputDateHandler();
                $(".form-full-event #event-id").val("");
                $(".form-full-event #event-name").val("");
                $(".form-full-event #start-date-time").data("DateTimePicker").date(moment(start));
                $(".form-full-event #end-date-time").data("DateTimePicker").date(moment(start).add(1, 'hours'));
                $(".event-categories[value='job']").prop('checked', true);
                $('.events-modal').modal();
            },
            eventClick: function(calEvent, jsEvent, view) {
                eventInputDateHandler();
                var eventId = calEvent._id;
                for (var i = 0; i < demoCalendar.length; i++) {
                    if (demoCalendar[i]._id == eventId) {
                        $(".form-full-event #event-id").val(eventId);
                        $(".form-full-event #event-name").val(demoCalendar[i].title);
                        $(".form-full-event #start-date-time").data("DateTimePicker").date(moment(demoCalendar[i].start));
                        $(".form-full-event #end-date-time").data("DateTimePicker").date(moment(demoCalendar[i].end));
                        if (demoCalendar[i].category == "" || typeof demoCalendar[i].category == "undefined") {
                            eventCategory = "Generic";
                        } else {
                            eventCategory = demoCalendar[i].category;
                        }
                        $(".event-categories[value='" + eventCategory + "']").prop('checked', true);
                    }
                }
                $('.events-modal').modal();
            }
        });

        demoCalendar = $("#full-calendar").fullCalendar("clientEvents");
    };

    var eventInputDateHandler = function() {
        var startInput = $('#start-date-time');
        var endInput = $('#end-date-time');
        startInput.datetimepicker({
            minDate: moment()
        });
        endInput.datetimepicker({
            minDate: moment()
        });
        startInput.on("dp.change", function(e) {
            endInput.data("DateTimePicker").minDate(e.date);
        });
        endInput.on("dp.change", function(e) {
            startInput.data("DateTimePicker").maxDate(e.date);
        });
    };

    return {
        init: function() {
            setFullCalendarEvents();
            runFullCalendar();
        }
    };
}();
