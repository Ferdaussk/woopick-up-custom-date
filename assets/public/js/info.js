//alert(skdisabledDates);
$(function() {
    function isInvalidDate(date) {
      // Disable days
      var disabledWeekdays = skdisabledWeekdays;
      if (disabledWeekdays.includes(date.day())) {
        return true;
      }
  
      // Disable specific dates
      var disabledDates = skdisabledDates; // Add your specific dates here
      return disabledDates.includes(date.format('YYYY-MM-DD'));
    }
  
    $('input[name="selected_date"]').daterangepicker({
      autoUpdateInput: false,
      timePicker: false,
      timePickerIncrement: 30,
      timePicker24Hour: false,
      timePickerSeconds: false,
      isInvalidDate: isInvalidDate, // Apply the isInvalidDate function
      locale: {
        format: skOrderDateFrmt,
        cancelLabel: 'Clear'
      }
    });
  
    $('input[name="selected_date"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format(skOrderDateFrmt) + ' to ' + picker.endDate.format(skOrderDateFrmt));
    });
  
    $('input[name="selected_date"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });
  });

  /*
DD MMM YYYY h:mm A ===== 03 Nov 2023 3:30 PM
YYYY-MM-DD HH:mm ===== 2023-11-03 23:03
MMMM D, YYYY h:mm A ===== November 3, 2023 2:30 AM
MMM D, YYYY h:mm A ======= Oct 31, 2023 4:30 AM
  */