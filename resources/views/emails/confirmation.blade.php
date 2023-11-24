<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <td>Dear {{$name}}!</td>
            </tr>
            <tr>
                <td>&nbsp;       </td>
            </tr>
            <tr>
                <td>Please click on the below link to active your account :- </td>
            </tr>
            <tr>
                <td>&nbsp;       </td>
            </tr>
            <tr>
                <td><a href="{{url('confirm/'.$code)}}">Confirm Account</a></td>
            </tr>
            <tr>
                <td>Thank you for become a part of the Ray family, </td>
            </tr>
            <tr>
                <td>best regards Rayeallistic Cosmetics</td>
            </tr>
        </table>
    </body>
</html>
