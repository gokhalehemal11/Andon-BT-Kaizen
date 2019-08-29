package com.example.dell.andon;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Button;
import android.widget.Toast;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    public int flag=1;
    //,flag_login=0;
    TextView e_id, e_pwd;
    Button login_btn;

    RadioButton supervisor, attendee, radiobutton;
    RadioGroup radioGroup;
    DatabaseReference ref;

    public static String e_pwd1 = new String();
    public static String e_name1 = new String();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        final TextView e_id = (TextView) findViewById(R.id.Login_eid);
        final TextView e_pwd = (TextView) findViewById(R.id.Login_pwd);
        login_btn = (Button) findViewById(R.id.Login_button);

        radioGroup = findViewById(R.id.radioGroup_login);
        supervisor = (RadioButton) findViewById(R.id.rb_supervisor);
        attendee = (RadioButton) findViewById(R.id.rb_attendee);

        login_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                int radioId = radioGroup.getCheckedRadioButtonId();
                radiobutton = findViewById(radioId);
                String position = (String) radiobutton.getText();

                e_name1 = e_id.getText().toString();
                e_pwd1 = e_pwd.getText().toString();

                if (position.equals("Supervisor")) {
                    System.out.println("inside supervisor" + e_name1 + e_pwd1);
                    FirebaseDatabase database = FirebaseDatabase.getInstance();
                    DatabaseReference myRef = database.getReference().child("employees");

                    myRef.addValueEventListener(new ValueEventListener() {
                        @Override
                        public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                            for (DataSnapshot child : dataSnapshot.getChildren()) {
                                Map<String, Object> newPost = (Map<String, Object>) child.getValue();

                                if (e_name1.equals(newPost.get("name")) && e_pwd1.equals(newPost.get("password"))) {
  //                                  flag_login=1;
                                    System.out.println("Accessed 1 " + newPost.get("name"));
                                    Toast.makeText(MainActivity.this, "Login Successful!", Toast.LENGTH_SHORT).show();
                                    Intent i = new Intent(getApplicationContext(), homepage.class);
                                    startActivity(i);
                                    break;
                                }
                                else
                                {
                                    Toast.makeText(MainActivity.this, "Login Failed!", Toast.LENGTH_SHORT).show();
                                }
                            }
                        }

                        @Override
                        public void onCancelled(@NonNull DatabaseError databaseError) {
                        }
                    });
                } else{
                    list("list1", e_name1, e_pwd1);
                    if(flag == 0){
                        list("list2",e_name1,e_pwd1);
                    }
                }
//                if(flag_login==0){
//                    System.out.println("Failedddd");
//                    Toast.makeText(MainActivity.this, "Login Failed!", Toast.LENGTH_SHORT).show();
//                }
            }
        });
    }

    public void checkbutton(View V) {
        int radioId = radioGroup.getCheckedRadioButtonId();
        radiobutton = findViewById(radioId);
    }

    public void list(String list_no, final String e_name2, final String e_pass2) {
        System.out.println("inside fn list"+list_no + e_name2 + e_pass2);
        DatabaseReference l1 = FirebaseDatabase.getInstance().getReference().child(list_no);
        l1.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                for (DataSnapshot ds : dataSnapshot.getChildren()) {
                    Map<String, Object> newPost2 = (Map<String, Object>) ds.getValue();
                    if (e_name2.equals(newPost2.get("name")) && e_pass2.equals(newPost2.get("password"))) {
                        //flag_login=1;
                        Toast.makeText(MainActivity.this, "Login Successful!", Toast.LENGTH_SHORT).show();
                        Intent i = new Intent(MainActivity.this, attend.class);
                        System.out.println("lalalalalalalalallala" + e_name2);
                        i.putExtra("name", e_name2);
                        i.putExtra("dept", newPost2.get("department").toString());
                        startActivity(i);
                        break;
                    }
                    else{
                        Toast.makeText(MainActivity.this, "Login Failed!", Toast.LENGTH_SHORT).show();
                    }
                }
                flag=0;
            }
            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {
            }
        });
    }
}