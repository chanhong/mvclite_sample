@using System.Collections.Specialized;
@using Co;

@{
  Layout = CUtils.GetLayout("_ejv");

  PageData["Title"] = "Edit a User Form";
  string iPath = CUtils.imgPath();

  string tsk = "jvadm";
  string mepath = string.Format("/{0}/index/", tsk);  // c use as sub-action such as clone, add, etc
  string meqs = CUtils.tap(mepath);
  string cmd = "";
  NameValueCollection one = new NameValueCollection {
    // field,"vaue"
    {"name","JV User" },
    {"email","chanhong@uw.edu" },
    {"password","password" },
    {"is_confirmed","0" },
    {"winuser","" },
    {"jvgroup","user" },
    {"jventity","UWMC" },
    {"jventities","UWMC|TEST" },
};

  NameValueCollection _qsa = CCore.qs2nvWithDefaultValue();
  string usrid = _qsa["p1"];
  if (CString.IsEmpty(usrid) == false)
  {
    cmd = "saveedit";
    PageData["title"] = "Edit a User Form";
    PageData["buttontitle"] = "Edit a User Info";
    PageData["action"] = meqs + "&c" + cmd;
    one = MJvAdm.GetUser("user_id='"+usrid+"'", CJv.DbEnv());
  }
  else
  {
    cmd = "savenew";
    PageData["title"] = "Create New User Form";
    PageData["buttontitle"] = "Create User";
//    PageData["action"] = meqs + "&c=savenew";
    PageData["action"] = meqs + "&c" + cmd;
  }
}
<script>
  $(document).ready(function () {
    // validate the form when it is submitted
    $("#EditForm").validate({
      rules: {
        email_login: {
          required: true,
          minlength: 2
        },
        password: {
          required: true,
          minlength: 6
        },
        name: {
          required: true,
          minlength: 6
        },
        email: {
          required: true,
          minlength: 8
        },
        jventities: {
          required: true,
          minlength: 3
        }
      },
      messages: {
        email_login: {
          required: "Please enter a username",
          minlength: "Must be at least 2 chars long"
        },
        password: {
          required: "Please provide a password",
          minlength: "Must be at least 6 chars long"
        },
        name: {
          required: "Please provide a name",
          minlength: "Must be at least 6 chars long"
        },
        email: {
          required: "Please provide an email",
          minlength: "Must be at least 8 chars long"
        },
        jventities: {
          required: "Please provide an entity",
          minlength: "Must be at least 3 chars long"
        }
      }
    });
  });
</script>
<div id="createUserForm" align="center">
  @Html.Raw(CHtml.FrmBeg(PageData["action"], "EditForm"))
  <fieldset>
    <legend>@PageData["title"]</legend>
    <p />
    <p>
      <label for="name">User Name (*)</label>
      <input id="name" name="name" title="First and Last is required!"
             class="required" minlength="6" value="@one["name"]" />
    </p>
    <p>
      <label for="email">Email (*)</label>
      <input id="email" name="email" title="Email is required!"
             class="required" type="text" minlength="6" value="@one["email"]" />
    </p>
    <p>
      <label for="email_login">JV User ID (*)</label>
      <input id="email_login" name="email_login" title="User Name is required!"
             class="required" type="text" minlength="2" value="@one["email_login"]" />
    </p>
    <p>
      <label for="password">JV User Password (*)</label>
      <input id="password" name="password" title="User Password is required!"
             class="required" type="text" minlength="6" value="@one["password"]" />
    </p>
    <p>
      <label for="is_confirmed">Confirmed?</label>
      <input id="is_confirmed" name="is_confirmed" title="Is Confirmed?"
             type="text" minlength="1" value="@one["is_confirmed"]" />
    </p>
    <p>
      <label for="winuser">Windows User ID</label>
      <input id="winuser" name="winuser" title="Windows User Name is optional!"
             type="text" value="@one["winuser"]" />
    </p>
    <p>
      <label for="jvgroup">JV User Group</label>
      <input id="jvgroup" name="jvgroup" title="JV Group is optional!"
             type="text" value="@one["jvgroup"]" />
    </p>
    <p>
      <label for="jventity">JV Entity</label>
      <input id="jventity" name="jventity" title="Default to UWMC"
             type="text" value="@one["jventity"]" />
    </p>
    <p>
      <label for="jventities">JV Entities</label>
      <input id="jventities" name="jventities" title=""
             type="text" value="@one["jventities"]" />
    </p>
    <p>
      <input type="hidden" id="user_id" name="user_id" value="@usrid" />
      <input type="hidden" id="cmd" name="cmd" value="@cmd" />
      <input class="submit"
             title="Edit User Info" type="submit" value="Save" />
    </p>
  </fieldset>
  @Html.Raw(CHtml.FrmEnd(CUtils.getReturnUrl()))
</div>