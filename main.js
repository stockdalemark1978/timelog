// var table = document.getElementById('table');
// var xRow = document.getElementsByTagName('tr');

// // function showtable(){
// //     table.style.display = block;
// // }

// function removeRow(){
//     table.deleteRow(this);

// }

// function validateItems() {
//     // clearErrors();
//     var logDate = document.forms["timeLogForm"]["date"].value;
//     var logActivity = document.forms["timeLogForm"]["activity"].value;
//     var logStartTime = document.forms["timeLogForm"]["startTime"].value;
//     var logEndTime = document.forms["timeLogForm"]["endTime"].value;
//     if (logDate == "" || isNaN(logDate)) {
//         // alert("date must be filled in with a number.");
//         document.forms["timeLogForm"]["date"]
//            .parentElement.className = "form-group has-error";
//         document.forms["timeLogForm"]["date"].focus();
//         // return false;
//     }
//    if ( logActivity == "" || !isNaN(logActivity)) {
//     //    alert("activity must be filled in with a number.");
//        document.forms["timeLogForm"]["activity"]
//           .parentElement.className = "form-group has-error"
//        document.forms["timeLogForm"]["activity"].focus();
//     //    return false;
//    }

//    if (logStartTime == "" || isNaN(logStartTime)) {
//     //    alert("startTime must be filled in with a number.");
//        document.forms["timeLogForm"]["startTime"]
//           .parentElement.className = "form-group has-error"
//        document.forms["timeLogForm"]["startTime"].focus();
//     //    return false;
//    }
//    if (logEndTime == "" || isNaN(logEndTime)) {
//     //    alert("endTime must be filled in with a number.");
//        document.forms["timeLogForm"]["endTime"]
//           .parentElement.className = "form-group has-error"
//        document.forms["timeLogForm"]["endTime"].focus();
//     //    return false;
//    }
// }