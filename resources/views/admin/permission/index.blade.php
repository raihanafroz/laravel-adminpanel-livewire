@extends('layouts.admin')

@section('stylesheet')
  <style>
    .permission-name{
      cursor: pointer;
    }
    .permission-name > input{
      cursor: pointer;
    }
  </style>
@endsection


@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Manage Permission</h2>
            </header>
            <div class="panel-body">
              <div class="row mt-5">
                <div class="col-2">
                </div>
                <div class="col-10">

                  @if(session()->has('status'))
                    {!! session()->get('status') !!}
                  @endif
                </div>
              </div>
              <form action="{{ route('permission.manage') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-6 offset-3">
                    <div class="form-group">
                      <label for="">Role</label>
                      <select name="role" class="form-control">
                        <option value="">Choose a Role</option>
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}" class="text-capitalize">{{ $role->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-12 mt-2">
                    <div id="permissions"></div>
                  </div>
                  <div class="col-12 mt-4 text-right">
                    <button type="submit" class="btn btn-sm btn-danger">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <script>
    $(document).ready(function () {
      $('select[name="role"]').on('change', function () {
        // role id
        const roleId = $(this).val();
        let output = "";
        let permissions = JSON.parse('{!! $permissions !!}');
        if (roleId !== "") {
          // get all permission based on role id
          $.ajax({
            url: "{{ route('ajax.get.permission.by.role') }}",
            method: "POST",
            dataType: "json",
            data: {role_id: roleId},
            success: function (currentPermissions) {
              if (currentPermissions.length > 0) {
                $.each(permissions, function (i, e) {
                  output += '<div class="row">'
                  output += '<div class="col-12">'
                  output += '<h6 class="text-capitalize"><label>' + i + '</label></h6>'
                  output += '</div>';
                  output += '<div class="col-12">'
                  output += '<div class="row">'
                  $.each(e, function (ii, ee) {
                    output += '<div class="d-inline mb-3 col-3">';
                    if (hasPermission(currentPermissions, ee.id)) {
                      output += '<label for="permission_' + ee.id + '" class="text-capitalize permission-name"><input type="checkbox" name="permission[]" id="permission_' + ee.id + '" value="' + ee.id + '" checked > ' + ee.name.replace(/_/g, " ") + '</label>';
                    } else {
                      output += '<label for="permission_' + ee.id + '" class="text-capitalize permission-name"><input type="checkbox" name="permission[]" id="permission_' + ee.id + '" value="' + ee.id + '" > ' + ee.name.replace(/_/g, " ") + '</label>';
                    }
                    output += '</div>';
                  })
                  output += '</div>';
                  output += '</div>';
                  output += '</div>';
                })
                $('#permissions').html(output);
              } else { // output all the permission without checked
                $.each(permissions, function (i, e) {
                  output += '<div class="row">'
                  output += '<div class="col-12">'
                  output += '<h6 class="text-capitalize"><label>' + i + '</label></h6>'
                  output += '</div>';
                  output += '<div class="col-12">'
                  output += '<div class="row">'
                  $.each(e, function (ii, ee) {
                    output += '<div class="d-inline mb-3 col-3">';
                    output += '<label for="permission_' + ee.id + '" class="text-capitalize permission-name"><input type="checkbox" name="permission[]" id="permission_' + ee.id + '" value="' + ee.id + '" > ' + ee.name.replace(/_/g, " ") + '</label>';
                    output += '</div>';
                  })
                  output += '</div>';
                  output += '</div>';
                  output += '</div>';
                })
                $('#permissions').html(output);
              }
            }
          })
        }
      })

      // checks if the user has permission
      function hasPermission(currentPermissions, permissionId) {
        let ret = false;
        $.each(currentPermissions, function (i, e) {
          if (Number(e.id) === Number(permissionId)) {
            ret = true
          }
        })
        return ret;
      }
    })
  </script>
@endsection
