<?php 
/* 
 * Load function based on the Ajax request 
 */ 
if(isset($_POST['func']) && !empty($_POST['func'])){ 
    switch($_POST['func']){ 
        case 'getCalender': 
        getCalender($_POST['year'],$_POST['month']); 
        break; 
        case 'getEvents': 
        getEvents($_POST['date']); 
        break; 
        default: 
        break; 
    } 
} 

/* 
 * Generate event calendar in HTML format 
 */ 
function getCalender($year = '', $month = ''){ 
    global $conn;
    $dateYear = ($year != '')?$year:date("Y"); 
    $dateMonth = ($month != '')?$month:date("m"); 
    $date = $dateYear.'-'.$dateMonth.'-01'; 
    $currentMonthFirstDay = date("N",strtotime($date)); 
    $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear); 
    $totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay); 
    $boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42; 
    ?> 
    <div class="calendar-wrap"> 
        <div class="cal-nav"> 
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&laquo;</a> 
            <select class="month_dropdown"><?php echo getAllMonths($dateMonth); ?></select> 
            <select class="year_dropdown"><?php echo getYearList($dateYear); ?></select> 
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&raquo;</a> 
        </div> 
        <div id="event_list" class="none"></div> 
        <div class="calendar-days"> 
            <ul> 
                <li>SUN</li> 
                <li>MON</li> 
                <li>TUE</li> 
                <li>WED</li> 
                <li>THU</li> 
                <li>FRI</li> 
                <li>SAT</li> 
            </ul> 
        </div> 
        <div class="calendar-dates"> 
            <ul> 
                <?php  
                $dayCount = 1; 
                $eventNum = 0; 
                for($cb=1;$cb<=$boxDisplay;$cb++){ 
                    if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){ 
                        // Current date 
                        $currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount; 
                        
                        // Include the database config file 
                        include_once 'includes/connect.php'; 
                        
                        // Get number of events based on the current date 
                        $result = $conn->query("SELECT event_name FROM tbl_reserve WHERE rdate = '".$currentDate."' AND status = 'approved'"); 
                        $eventNum = $result->num_rows; 
                        
                        // Define date cell color 
                        if(strtotime($currentDate) == strtotime(date("Y-m-d"))){ 
                            echo '<li date="'.$currentDate.'" class="grey date_cell">'; 
                        }elseif($eventNum > 0){ 
                            echo '<li date="'.$currentDate.'" class="light_sky date_cell">'; 
                        }else{ 
                            echo '<li date="'.$currentDate.'" class="date_cell">'; 
                        } 
                        
                        // Date cell 
                        echo '<span>'; 
                        echo $dayCount; 
                        echo '</span>'; 
                        
                        // Hover event popup 
                        echo '<div style="margin-top: 23px;" id="date_popup_'.$currentDate.'">'; 
                        echo '<div class="date_window">'; 
                        echo ($eventNum > 0)?'<a class="asd font-weight-normal text-success" href="javascript:;" onclick="getEvents(\''.$currentDate.'\');">View</a>':''; 
                        echo '</div></div>'; 
                        
                        echo '</li>'; 
                        $dayCount++; 
                        ?> 
                    <?php }else{ ?> 
                        <li><span>&nbsp;</span></li> 
                    <?php } } ?> 
                </ul> 
            </div> 
        </div> 
        
        <script> 
            function getCalendar(target_div, year, month){ 
                $.ajax({ 
                    type:'POST', 
                    url:'calendar.php', 
                    data:'func=getCalender&year='+year+'&month='+month, 
                    success:function(html){ 
                        $('#'+target_div).html(html); 
                    } 
                }); 
            } 
            
            function getEvents(date){ 
                $.ajax({ 
                    type:'POST', 
                    url:'calendar.php', 
                    data:'func=getEvents&date='+date, 
                    success:function(html){ 
                        $('#event_list').html(html); 
                        $('#event_list').slideDown('slow'); 
                    } 
                }); 
            } 
            
            $(document).ready(function(){ 
                $('.date_cell').mouseenter(function(){ 
                    date = $(this).attr('date'); 
                    $(".date_popup_wrap").fadeOut(); 
                    $("#date_popup_"+date).fadeIn();     
                }); 
                $('.date_cell').mouseleave(function(){ 
                    $(".date_popup_wrap").fadeOut();         
                }); 
                $('.month_dropdown').on('change',function(){ 
                    getCalendar('calendar_div', $('.year_dropdown').val(), $('.month_dropdown').val()); 
                }); 
                $('.year_dropdown').on('change',function(){ 
                    getCalendar('calendar_div', $('.year_dropdown').val(), $('.month_dropdown').val()); 
                }); 
                $(document).click(function(){ 
                    $('#event_list').slideUp('slow'); 
                }); 
            }); 
        </script> 
        <?php 
    } 
    
/* 
 * Generate months options list for select box 
 */ 
function getAllMonths($selected = ''){ 
    $options = ''; 
    for($i=1;$i<=12;$i++) 
    { 
        $value = ($i < 10)?'0'.$i:$i; 
        $selectedOpt = ($value == $selected)?'selected':''; 
        $options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>'; 
    } 
    return $options; 
} 

/* 
 * Generate years options list for select box 
 */ 
function getYearList($selected = ''){ 
    $options = ''; 
    for($i=2019;$i<=2025;$i++) 
    { 
        $selectedOpt = ($i == $selected)?'selected':''; 
        $options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>'; 
    } 
    return $options; 
} 

/* 
 * Generate events list in HTML format 
 */ 
function getEvents($date = ''){ 
    // Include the database config file 
    include_once 'includes/connect.php'; 
    
    $eventListHTML = ''; 
    $date = $date?$date:date("Y-m-d"); 
    
    // Fetch events based on the specific date 
    $result = $conn->query("SELECT event_name, rstart, rend FROM tbl_reserve WHERE rdate = '".$date."' AND status = 'approved'"); 
    if($result->num_rows > 0){ 
        $eventListHTML = '<h3 class="text-center font-weight-normal mt-2">Events on '.date("l, d M Y",strtotime($date)).'</h3>'; 
        while($row = $result->fetch_assoc()){  
            $eventListHTML .= '<p class="text-center font-weight-normal">'.$row['event_name'].' '. date('h:i A', strtotime($row["rstart"])) .' to '. date('h:i A', strtotime($row["rend"])) .'</p>'; 
        } 
    } 
    echo $eventListHTML; 
}