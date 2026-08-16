@using System.Collections.Specialized;
@using Co;

@{
  Layout = CUtils.GetLayout("_ejv");
  if (PageData["Title"] == AppState["Name"])
  {
    PageData["Title"] = "JV Approver Help";
  }
}
<div>
  <table>
    <tbody><tr><td>
  <p align="center">
    <b>
      Note:
    </b> The list of JVs shows only the JV's that have not yet been mailed out OR not yet voided.  Once a JV is either mailed or voided, it disappears from the list.
  </p>
  <hr />
  <p align="center">
    <B>'Gee whiz' stuff about the text file:</B>
  </p>
  <p>
    <b>
      1.
    </b>
    Here's what the filename of the text file means: "F__accounting month__calendar month__day of the month__sequence-number_.JV "
    <br />    <b>
      2.
    </b> The text file won't be created until after you've approved the JV.
  </p>
  <p align="center">
    <B>** FTP-ing  -- the steps:</B>
  </p>
  <p>
    <b>
      1.
    </b>
    You can wait till you've got multiple JV's to ftp before ftping any of them; saves time.
    <br />
    <b>
      2.
    </b>
    Open your "SSH FTP Client" icon, click on its icon of an open folder, and select FASTRANS, to send to fastrans the text files for all jv's in this table which have been approved and not yet ftpd.  If there's a JV that you haven't approved in the list above, there won't be any textfile of it to ftp, you're not in danger of accidentally sending up a JV that you haven't yet approved.
    <br />
    <b>
      3.
    </b>
    Click on the up arrow, go to the mapped drive that has the whatever.  JV that you want to upload to campus, and double click on the filename(s).
    <br /><b>4.</b> Then go back to the list of JVs to change the FTP status for the JV(s) to "Y".
  </p>

  <p align="center">
    <B>** Submitting the ftp'd JV's -- the steps:</B>
  </p>
  <p>
    <b>
      1.
    </b>
    You can wait till you've got multiple JV's to submit before submitting any of them; saves time.
    <br />
    <b>
      2.
    </b>
    Open the SSH Secure Shell program, and click on its computer-monitor-with-bubbles icon.
    <br />
    <b>
      3.
    </b>
    Use its menu of choices to submit the JV.
    <br />
    <b>4.</b> Then come back here to change the submit status for the JV to "Y".
  </p>
  <hr />
  <p align="center">
    <b>New:</b>
  </p>
  <p>
    <b>
      1.
    </b> "Approved" with "Y" status can be toggled to "P" to regenerate a new archive and textfile.
    <br />    <b>
      2.
    </b> (Incompleted) "Mailout?" with "Y" status can be toggled to "R" to rename the previous failed "mailout" to re-send the archive file.
  </p>
</td>
</tr>
    </tbody>
  </table>
</div>