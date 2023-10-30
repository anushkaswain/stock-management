<?php

$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");
//declaring BOOLEAN VARIABLES TO 0
$V1 = 0;
$V2 = 0;
$V3 = 0;
$V4 = 0;
//Initiating empty variables 
$Year = "";
$Category= "";
$Period="";
$PCode="";
//isset is for the form we are submitting . even if we click  submit  button without entering anything , we are actualy sending null  values for each field . isset here will return true 
//when we are just opening the report page after login in this case all the form field variables are not going to be processed by default . here isset is false . 
if(isset($_POST["Year"])){
    $Year = $_POST["Year"];
    if($Year!=""){
        $V1 = 1;
    }
}
if(isset($_POST["Period"])){
    $Period = $_POST["Period"];
    if($Period!=""){
        $V2 = 1;
    }
}
if(isset($_POST["Category"])){
    $Category = $_POST["Category"];
    if($Category!=""){
        $V3 = 1;
    }
}
if(isset($_POST["PCode"])){
    $PCode = $_POST["PCode"];
    if($PCode!=""){
        $V4 = 1;
    }
}
function func($num)
{
    return $num * $num;
}
//V1 , v2 v3 , v4 result found 
//$Year , $period , $category , $PCode found

//function to find current working year
$current_year = date("Y");
$current_month = date("m");
      
if((int)$current_month<4)
{
    $current_year-=1;
    $START_DATE = ($current_year."-"."04"."-"."01");
    $current_year+=1;
    $END_DATE =($current_year."-"."03"."-"."31");
}
else
{

    $START_DATE = ($current_year."-"."04"."-"."01");
    $current_year+=1;
    $END_DATE =($current_year."-"."03"."-"."31");
}

//function to find START DATE AND END DATE if year mentioned
$YEAR_START = ($Year."-"."04"."-"."01");
$YEAR_END = (((string)((int)$Year+1))."-"."03"."-"."31");
$Type_of_sql = 0;
switch($V1.$V2.$V3.$V4)
{
    case "0000":
        //submitting all empty values . result will show for present year ,monthly , all products . same as default 
                $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE Date BETWEEN '$START_DATE' AND '$END_DATE' GROUP BY Code,MONTH(Date) ORDER BY Code ";

    break;
    case "0001":
       //year not mentioned so we take this year
       //period empty by default monthly
       //category none
       //product code is set so we will show for this particular product
       $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$START_DATE' AND '$END_DATE') AND Code='$PCode' GROUP BY Code,MONTH(Date) ORDER BY Code ";

    break;
    case "0010":
        //almost same as 0001 case . insted of code we will search by category
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$START_DATE' AND '$END_DATE') AND Code LIKE '$Category%' GROUP BY Code,MONTH(Date) ORDER BY Code ";

    break;
    case "0011":
        //dummy case .  if code and category both mentioned code have higher priority . table will be shown with reference to code
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$START_DATE' AND '$END_DATE') AND Code='$PCode' GROUP BY Code,MONTH(Date) ORDER BY Code ";
    break;
    case "0100":
        //only period set
        //what does this mean 
        //see here monthy will not be set as we are discarding it in report.php code as ainvalid case
        //only yearly case need to be solved .
        //since this have a diffrent table structure the sql code structure will be diffrent for this 
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month , YEAR(Date) as year FROM issue GROUP BY Code ,MONTH(Date),YEAR(Date) ORDER BY Code , year, month";
        $Type_of_sql =1;


    break;
    case "0101":
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month , YEAR(Date) as year FROM issue WHERE Code='$Pcode' GROUP BY Code ,MONTH(Date),YEAR(Date) ORDER BY Code , year, month";
        $Type_of_sql =1;
    break;
    case "0110":
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month , YEAR(Date) as year FROM issue WHERE Code LIKE '$Category%' GROUP BY Code ,MONTH(Date),YEAR(Date) ORDER BY Code , year, month";
        $Type_of_sql =1;
    break;
    case "0111":
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month , YEAR(Date) as year FROM issue WHERE Code='$Pcode' GROUP BY Code ,MONTH(Date),YEAR(Date) ORDER BY Code , year, month";
        $Type_of_sql =1;
    break;
    case "1000":
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE Date BETWEEN '$YEAR_START' AND '$YEAR_END' GROUP BY Code,MONTH(Date) ORDER BY Code ";

    break;
    case "1001":
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code='$PCode' GROUP BY Code,MONTH(Date) ORDER BY Code ";
    break;
    case "1010":
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code LIKE '$Category%' GROUP BY Code,MONTH(Date) ORDER BY Code ";
    break;
    case "1011":
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code='$PCode' GROUP BY Code,MONTH(Date) ORDER BY Code ";
    break;
    case "1100":
        if($Period=="M")
        {
            $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE Date BETWEEN '$YEAR_START' AND '$YEAR_END' GROUP BY Code,MONTH(Date) ORDER BY Code ";

        }
        else
        {
            $sql = "SELECT sum(NoOfItems) as count,Code , ProductName FROM issue WHERE Date BETWEEN '$YEAR_START' AND '$YEAR_END' GROUP BY Code ORDER BY Code ";
            $Type_of_sql = 2;
        }
    break;
    case "1101":
        if($Period=="M")
        {
            $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code='$PCode' GROUP BY Code,MONTH(Date) ORDER BY Code ";

        }
        else
        {
            $sql = "SELECT sum(NoOfItems) as count,Code , ProductName FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code='$PCode' GROUP BY Code ORDER BY Code ";
            $Type_of_sql = 2;
        }
    break;
    case "1110":
        if($Period=="M")
        {
            $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code LIKE '$Category%' GROUP BY Code,MONTH(Date) ORDER BY Code ";

        }
        else
        {
            $sql = "SELECT sum(NoOfItems) as count,Code , ProductName FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code LIKE '$Category%' GROUP BY Code ORDER BY Code ";
            $Type_of_sql = 2;
        }
    break;
    case "1111":
        if($Period=="M")
        {
            $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code='$PCode' GROUP BY Code,MONTH(Date) ORDER BY Code ";

        }
        else
        {
            $sql = "SELECT sum(NoOfItems) as count,Code , ProductName FROM issue WHERE (Date BETWEEN '$YEAR_START' AND '$YEAR_END') AND Code='$PCode' GROUP BY Code ORDER BY Code ";
            $Type_of_sql = 2;
        }
    break;
    default:
        $sql = "SELECT sum(NoOfItems) as count,Code , ProductName, MONTH(Date) as month FROM issue WHERE Date BETWEEN '$START_DATE' AND '$END_DATE' GROUP BY Code,MONTH(Date) ORDER BY Code ";
    

}
//sql execution
$result = mysqli_query($conn , $sql ) or die("SQL Query Failed");

//sql output processing
$output = "";
$J = date('Y-m-d');
$map = array("1" => "January", 
"2" => "February",
"3" => "March",
"4" => "April",
"5" => "May",
"6" => "June",
"7" => "July",
"8" => "August",
"9" => "September",
"10" => "October",
"11" => "November",
"12" => "December"

);
$map2 = array("2022" => "2022-2023", 
"2023" => "2023-2024",
);

switch($Type_of_sql)
{
    case 0:
        if(mysqli_num_rows($result)>0)
        {
            $output = '<table>';

            $CodeTemp ="";
            $total = 0;
            while($row = mysqli_fetch_assoc($result)){
                if($row["Code"]!=$CodeTemp)
                {
                    $CodeTemp = $row["Code"];
                    if($total!=0)
                    {
                        $output .= "<tr class='total'><td>Total</td><td>{$total}</td></tr>";
                    }
                    $total = 0;
                    $output .= "<tr> <th>{$row["Code"]} : {$row["ProductName"]}</th><th></th></tr>";
                    
                }
                
                $total += $row["count"];
                $output .= "<tr>

                <td>{$map[$row["month"]]}</td>
                <td>{$row["count"]}</td>

                </tr>";
            }

            $output .= "<tr class='total'><td >Total</td><td>{$total}</td></tr>";


            mysqli_close($conn);


        }
        break;
    case 1:
        if(mysqli_num_rows($result)>0)
        {
            $output = '<table>';
            $YearTemp = "";
            $MonthTemp = "";
            $Yeartotal = 0;
            $CodeTemp ="";
            $total = 0;
            while($row = mysqli_fetch_assoc($result)){
                if($row["Code"]!=$CodeTemp)
                {
                    if($Yeartotal!=0 and $MonthTemp>=4)
                    {
                        $output .= "<tr><td>{$map2[$row["year"]]}</td> <td>{$Yeartotal}</td></tr>";
                    }
                    if($Yeartotal != 0 and $MonthTemp<4)
                    {
                        $output .= "<tr><td>{$map2[$row["year"]-1]}</td> <td>{$Yeartotal}</td></tr>";
                    }
                    $total +=$Yeartotal;
                    $Yeartotal=0;

                    if($total!=0)
                    {
                        $output .= "<tr class='total'><td>Total</td><td>{$total}</td></tr>";
                    }
                    $total = 0;
                    $CodeTemp = $row["Code"];
                    $output .= "<tr> <th>{$row["Code"]} : {$row["ProductName"]}</th><th></th></tr>";
                    
                }
                $MonthTemp = $row["month"];
                $YearTemp = $row["year"];
                if($row["month"]=="4")
                {
                    $output .= "<tr>
                    <td>{$map2[$row["year"]-1]}</td>
                    <td>{$Yeartotal}</td>
                    </tr>";
                    $total += $Yeartotal;
                    $Yeartotal = 0;
                }

                $Yeartotal += $row["count"];

            
            }

            if($MonthTemp<4)
                    {
                        $output .= "<tr><td>{$map2[$YearTemp-1]}</td> <td>{$Yeartotal}</td></tr>";
                    }
                    else
                    {
                        $output .= "<tr><td>{$map2[$YearTemp]}</td> <td>{$Yeartotal}</td></tr>";
                    }

            $total +=$Yeartotal;
            
            $output .= "<tr class='total'><td >Total</td><td>{$total}</td></tr>";


            mysqli_close($conn);


        }
        
        break;
    case 2:
        if(mysqli_num_rows($result)>0)
        {
            $output = '<table>';
            $output .= '<tr>
            <th>CODE:PRODUCTNAME</th>
            <th>CONSUMPTION</th>
            </tr>';
            while($row = mysqli_fetch_assoc($result)){
            
                $output .= "<tr><td>{$row["Code"]} : {$row["ProductName"]}</td><td>{$row["count"]}</td></tr>";
                    
                
            }


            mysqli_close($conn);


        }
        break;
    default:
        
    
}

$output .="
<tr class='footer'>
<th>SYSTEM GENERATED REPORT ON {$J}</th>
<th></th>
</tr>
";
$output .= "</table>";

echo($output);

?>
