<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;border: 1px solid #cccccc;">
    <tr>
        <td bgcolor="#ffffff" style="padding: 25px 30px 10px 30px;">
            <table border="0" cellpadding="5" cellspacing="0" width="100%">
                <tr>
                    <td style="width:85px;font-weight: bold;">Name:</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td style="width:85px;font-weight: bold;">Email Id:</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td style="width:85px;font-weight: bold;">Contact No:</td>
                    <td><?php echo $contact; ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" style="padding: 10px 30px 30px 30px;">
            <table border="1" cellpadding="7" cellspacing="0" width="100%" style="border-color:#ffffff;">
                <tr valign="top">
                    <th>
                        Value
                    </th>
                    <th>
                        Voltage
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Specific Requirements
                    </th>
                </tr>
                <?php foreach($productEnquiry as $row) { ?>
                <tr valign="top">
                    <td>
                        <?php echo $row['value']; ?>
                    </td>
                    <td>
                        <?php echo $row['voltage']; ?>
                    </td>
                    <td>
                        <?php echo $row['categoryName']; ?>
                    </td>
                    <td>
                        <?php echo $row['misc']; ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
</table>