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

<p class="textemail">This is to bring in your notice that, there is some comments mention on a screening of reference no:{{$details['reference_no']}}, written by {{$details['comment_by']}}<br>
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
            <th>Comment</th>
            <th>Comment By</th>
        </tr>
        <tr>
            <td>{{$details['reference_no']}}</td>
            <td>{{$details['employee_name']}} {{$details['employee_surname']}}</td>
            <td>{{$details['nic']}}</td>
            <td>{{$details['region']}}</td>
            <td>{{$details['field_office']}}</td>
            <td>{{$details['comment']}}</td>
            <td>{{$details['comment_by']}}</td>
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
            <td><strong>Comment</strong></td>
            <td>{{$details['comment']}}</td>
        </tr>
        <tr>
            <td><strong>Comment By</strong></td>
            <td>{{$details['comment_by']}}</td>
        </tr>
    </tbody>--}}
</table>
 <br><br>
<p>Follow the link to view details: </p><a href="{{$details['email_link']}}" target="_blank">{{$details['email_link']}}</a>
<br>
<p class="textemail">Kindly proceed with further necessary action.<br><br>
Thank You</p>

