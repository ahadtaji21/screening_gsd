<style>
    .textemail{
        font-family: Arial, Helvetica, sans-serif;
    }

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 50%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>
<strong class="textemail">Greetings from Global Screening Database!</strong><br><br><br>

<p class="textemail">This is to bring in your notice that, screening result has been declared and entered in GSD by {{$details['created_by']}}<br>
The record details is below:</p><br>
<br>

<table id="customers">
    <tbody>
        <tr>
            <th>Ref.#</th>
            <th>Employee</th>
            <th>National ID#</th>
            <th>Region</th>
            <th>Field Office</th>
            <th>Department</th>
        </tr>
        <tr>
            <td>{{$details['reference_no']}}</td>
            <td>{{$details['employee_name']}} {{$details['employee_surname']}}</td>
            <td>{{$details['nic']}}</td>
            <td>{{$details['region']}}</td>
            <td>{{$details['field_office']}}</td>
            <td>{{$details['department']}}</td>

        </tr>
        <tr>
            <th>Type of Staff</th>
            <th>Job Title</th>
            <th>Line Manager Job Title</th>
            <th>Status</th>
            <th>Result</th>
            <th>Screening Date</th>
        </tr>
        <tr>
            <td>{{$details['staff_type']}}</td>
            <td>{{$details['designation']}}</td>
            <td>{{$details['line_manager']}}</td>
            <td>{{$details['status']}}</td>
            <td>{{$details['result']}}</td>
            <td>{{$details['screening_date']}}</td>
        </tr>

    </tbody>
    {{--<thead>

    <tr>
        <th colspan="2">Details</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Employee name</strong></td>
            <td>{{$details['employee_name']}}</td>
        </tr>
        <tr>
            <td><strong>Reference no</strong></td>
            <td>{{$details['reference_no']}}</td>
        </tr>
        <tr>
            <td><strong>National ID</strong></td>
            <td>{{$details['nic']}}</td>
        </tr>
        <tr>
            <td><strong>Region</strong></td>
            <td>{{$details['region']}}</td>
        </tr>
        <tr>
            <td><strong>Field Office</strong></td>
            <td>{{$details['field_office']}}</td>
        </tr>
        <tr>
            <td><strong>Type of Staff</strong></td>
            <td>{{$details['staff_type']}}</td>
        </tr>
        <tr>
            <td><strong>Job Title</strong></td>
            <td>{{$details['designation']}}</td>
        </tr>
        <tr>
            <td><strong>Department</strong></td>
            <td>{{$details['department']}}</td>
        </tr>
        <tr>
            <td><strong>Line Manager Job Title</strong></td>
            <td>{{$details['line_manager']}}</td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td>{{$details['status']}}</td>
        </tr>
        <tr>
            <td><strong>Result</strong></td>
            <td><strong>{{$details['result']}}</strong></td>
        </tr>
        <tr>
            <td><strong>Screening Date</strong></td>
            <td><strong>{{$details['screening_date']}}</strong></td>
        </tr>
    </tbody>--}}
</table>
 <br><br>
<p>Follow the link to view details: </p><a href="{{$details['email_link']}}" target="_blank">{{$details['email_link']}}</a>
<br>
<p class="textemail">Kindly proceed with further necessary action.<br><br>
Thank You</p>

