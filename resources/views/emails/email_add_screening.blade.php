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

<p class="textemail">This is to bring in your notice that, new screening detail has been entered<br>
The record details is below:</p><br>
<br>


<table id="customers" style="width: 100%">
    <tbody>
    <tr>
        <th>Ref.#</th>
        <th>Employee</th>
        <th>National ID#</th>
        <th>Region</th>
        <th>Field Office</th>
    </tr>
    <tr>
        <td>{{$details['reference_no']}}</td>
        <td>{{$details['employee_name']}} {{$details['employee_surname']}}</td>
        <td>{{$details['nic']}}</td>
        <td>{{$details['region']}}</td>
        <td>{{$details['field_office']}}</td>
    </tr>
    <tr>
        <th>Type of Staff</th>
        <th>Job Title</th>
        <th>Department</th>
        <th>Line Manager Job Title</th>
        <th>Screening Status</th>
    </tr>
    <tr>
        <td>{{$details['staff_type']}}</td>
        <td>{{$details['designation']}}</td>
        <td>{{$details['department']}}</td>
        <td>{{$details['line_manager']}}</td>
        <td>{{$details['status']}}</td>
    </tr>

    {{--<tr>
        <td><strong>Employee name</strong></td>
        <td>{{$details['employee_name']}}</td>
    </tr>
    <tr>
            <td><strong>Reference no</strong></td>
            <td>{{$details['reference_no']}}</td>
        </tr>
        <tr>
            <td><strong>National ID #</strong></td>
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
        </tr>--}}
    </tbody>
</table>
{{--<table id="customers">
    <thead>

    <tr>
        <th colspan="10">Details of Screening</th>
    </tr>
    <tr>
        <th>Employee Name</th>
        <th>Reference no.</th>
        <th>national ID</th>
        <th>Region</th>
        <th>Field Office</th>
        <th>Type of Staff</th>
        <th>Job Title</th>
        <th>Department</th>
        <th>Line Manager Title</th>
        <th>Status</th>
    </tr>

    </thead>
    <tbody>
    @foreach($details as $d)
        <tr>
            <td>{{ $d['employee_name'] }}</td>
            <td>{{ $d['reference_no'] }}</td>
            <td>{{ $d['nic'] }}</td>
            <td>{{ $d['region'] }}</td>
            <td>{{ $d['field_office'] }}</td>
            <td>{{ $d['staff_type'] }}</td>
            <td>{{ $d['designation'] }}</td>
            <td>{{ $d['department'] }}</td>
            <td>{{ $d['line_manager'] }}</td>
            <td>{{ $d['status'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>--}}
 <br><br>
<p>Follow the link to view details: </p><a href="{{$details['email_link']}}" target="_blank">{{$details['email_link']}}</a>
<br>
<p class="textemail">Kindly proceed with further necessary action.<br><br>
Thank You</p>

