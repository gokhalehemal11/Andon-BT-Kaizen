package com.example.dell.andon;

import android.Manifest;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.net.Uri;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.telephony.SmsManager;
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

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Map;


public class homepage extends AppCompatActivity {

    private static final String[] paths = {"Black Steel", "White Steel", "Final Assembly", "Testing"};
    private static final int per= 0;
    public Date init_date= new Date();
    public String dept, location= new String();
    public String fetched_dept= new String();
    public String fetched_loc= new String();

    RadioGroup radioGroup_dept, radioGroup_loc;
    RadioButton safety, quality, warehouse, tooling, methods, plantengg, rb_Black, rb_White, rb_FinalA, rb_Testing,radiobutton_dep,radiobutton_loc;
    Button help, finish, emergency;
    TextView mTextField;
    int val=0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.homepage);


        radioGroup_dept=findViewById(R.id.radioGroup_dept);
        safety= (RadioButton)findViewById(R.id.rb_HSE);
        quality= (RadioButton)findViewById(R.id.rb_quality);
        warehouse= (RadioButton)findViewById(R.id.rb_wareh);
        tooling= (RadioButton)findViewById(R.id.rb_Tooling);
        methods= (RadioButton)findViewById(R.id.rb_methods);
        plantengg= (RadioButton)findViewById(R.id.rb_Plantengg);

        radioGroup_loc= findViewById(R.id.radiogroup_locatn);
        rb_Black= (RadioButton)findViewById(R.id.rb_Black);
        rb_White= (RadioButton)findViewById(R.id.rb_White);
        rb_FinalA= (RadioButton)findViewById(R.id.rb_FinalA);
        rb_Testing= (RadioButton)findViewById(R.id.rb_Testing);

        help= (Button) findViewById(R.id.btn_help);
        finish= (Button) findViewById(R.id.btn_finish);
        emergency= (Button) findViewById(R.id.btn_emergency);
        mTextField= (TextView) findViewById(R.id.textview);

//        finish.setEnabled(false);
        FirebaseDatabase database5= FirebaseDatabase.getInstance();
        DatabaseReference myRef5 = database5.getReference().child("attend");
        myRef5.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                if(dataSnapshot.getValue().equals("1")){
                    finish.setEnabled(true);
                }
                else{
                    finish.setEnabled(false);
                   // finish.setTextColor(0xFF0000); // 0xAARRGGBB
                }
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });
        finish.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                FirebaseDatabase database4= FirebaseDatabase.getInstance();
                DatabaseReference myRef4 = database4.getReference().child("attend");
                myRef4.setValue("0");
                Toast.makeText(getApplicationContext(),"Issue Resolved !",Toast.LENGTH_SHORT).show();
                System.out.println("lalalalalal"+ init_date);
                DatabaseReference rootRef = FirebaseDatabase.getInstance().getReference();
                DatabaseReference tasksRef = rootRef.child("logs").push();
                DateFormat df = new SimpleDateFormat("EEE, d MMM yyyy, HH:mm");
                String date = df.format(Calendar.getInstance().getTime());
                tasksRef.setValue("Issue is "+fetched_dept +" at "+ fetched_loc+"  Initialization time: "+init_date+" Finish Time: "+ date);

                Intent browserIntent =new Intent(Intent.ACTION_VIEW, Uri.parse("https://forms.gle/QpMGTuVvAKWmHo2B7"));
                startActivity(browserIntent);
            }
        });

        help.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int radioId_dept = radioGroup_dept.getCheckedRadioButtonId();
                int radioId_loc = radioGroup_loc.getCheckedRadioButtonId();
                radiobutton_dep = findViewById(radioId_dept);
                radiobutton_loc = findViewById(radioId_loc);
               // System.out.println(radiobutton_dep.getText());



                dept= (String) radiobutton_dep.getText();
                location=(String) radiobutton_loc.getText();

                System.out.println("lets test"+ dept + location);
                init_date= Calendar.getInstance().getTime();

                FirebaseDatabase database= FirebaseDatabase.getInstance();
                DatabaseReference myRef = database.getReference().child("list1");
                myRef.addValueEventListener(new ValueEventListener() {
                    @Override
                    public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                        for (DataSnapshot child: dataSnapshot.getChildren()){
                            Map<String, Object> newPost = (Map<String, Object>) child.getValue();
                            // System.out.println("hi"+ dept);
                            if(dept.equals(newPost.get("department"))){
                                System.out.println("Accessed "+ newPost.get("phone"));

                                //  ActivityCompat.requestPermissions();

                                if(ContextCompat.checkSelfPermission(getApplicationContext(),Manifest.permission.SEND_SMS) != PackageManager.PERMISSION_GRANTED){
                                    if(ActivityCompat.shouldShowRequestPermissionRationale(homepage.this,Manifest.permission.SEND_SMS)){

                                    }
                                    else{
                                        ActivityCompat.requestPermissions( homepage.this, new String[]{Manifest.permission.SEND_SMS},per);
                                    }
                                }

                                SmsManager smgr = SmsManager.getDefault();
                                smgr.sendTextMessage( newPost.get("phone").toString(),null,dept+ " issue occured in "+ location +"!\n  Level 1",null,null);
                                //Toast.makeText(getApplicationContext(),"Message Sent to List 1",Toast.LENGTH_LONG).show();
                                new AlertDialog.Builder(homepage.this)
                                        .setTitle("Message Sent")
                                        .setMessage("Message Sent to List 1")

                                        // Specifying a listener allows you to take an action before dismissing the dialog.
                                        // The dialog is automatically dismissed when a dialog button is clicked.
                                        .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                            public void onClick(DialogInterface dialog, int which) {
                                                // Continue with delete operation
                                            }
                                        })
                                        // A null listener allows the button to dismiss the dialog and take no further action.
                                        .setNegativeButton(android.R.string.no, null)
                                        .setIcon(android.R.drawable.ic_dialog_alert)
                                        .show();

                                new CountDownTimer(30000, 1000) {

                                    public void onTick(long millisUntilFinished) {
                                        mTextField.setText("seconds remaining: " + millisUntilFinished / 1000);
                                    }

                                    public void onFinish() {

                                        FirebaseDatabase database2= FirebaseDatabase.getInstance();
                                        DatabaseReference myRef2 = database2.getReference().child("attend");
                                        myRef2.addValueEventListener(new ValueEventListener() {
                                            @Override
                                            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                                                try {
                                                    //System.out.println("Waiting for 100 saal");
                                                        /* Thread.sleep(30000);
                                                         chronometer.setBase(SystemClock.elapsedRealtime());
                                                         chronometer.start();
                                                         */

                                                    System.out.println("Attend: "+ dataSnapshot.getValue());
                                                    if(dataSnapshot.getValue().toString().equals("0")){
                                                        FirebaseDatabase database3= FirebaseDatabase.getInstance();
                                                        DatabaseReference myRef3 = database3.getReference().child("list2");
                                                        myRef3.addValueEventListener(new ValueEventListener() {
                                                            @Override
                                                            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                                                                for (DataSnapshot child2: dataSnapshot.getChildren()){
                                                                    Map<String, Object> newPost = (Map<String, Object>) child2.getValue();
                                                                    if(dept.equals(newPost.get("department"))){
                                                                        System.out.println("Accessed for list 2 "+ newPost.get("phone"));
                                                                        if(ContextCompat.checkSelfPermission(getApplicationContext(),Manifest.permission.SEND_SMS) != PackageManager.PERMISSION_GRANTED){
                                                                            if(ActivityCompat.shouldShowRequestPermissionRationale(homepage.this,Manifest.permission.SEND_SMS)){

                                                                            }
                                                                            else{
                                                                                ActivityCompat.requestPermissions( homepage.this, new String[]{Manifest.permission.SEND_SMS},per);
                                                                            }
                                                                        }
                                                                        SmsManager smgr = SmsManager.getDefault();
                                                                        smgr.sendTextMessage( newPost.get("phone").toString(),null,dept+ " issue occured in "+ location +"!\n  Level 2",null,null);
                                                                        //Toast.makeText(getApplicationContext(),"Message Sent to List 2",Toast.LENGTH_LONG).show();
                                                                        new AlertDialog.Builder(homepage.this)
                                                                                .setTitle("Message Sent")
                                                                                .setMessage("Message Sent to List 2")

                                                                                // Specifying a listener allows you to take an action before dismissing the dialog.
                                                                                // The dialog is automatically dismissed when a dialog button is clicked.
                                                                                .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                                                                    public void onClick(DialogInterface dialog, int which) {
                                                                                        // Continue with delete operation
                                                                                    }
                                                                                })
                                                                                // A null listener allows the button to dismiss the dialog and take no further action.
                                                                                .setNegativeButton(android.R.string.no, null)
                                                                                .setIcon(android.R.drawable.ic_dialog_alert)
                                                                                .show();
                                                                    }
                                                                }
                                                            }

                                                            @Override
                                                            public void onCancelled(@NonNull DatabaseError databaseError) {

                                                            }
                                                        });

                                                    }
                                                    else{
                                                        Log.d("notsent","Already attended");
                                                    }
                                                } catch (Exception e) {
                                                    System.out.println("Error");
                                                }
                                            }

                                            @Override
                                            public void onCancelled(@NonNull DatabaseError databaseError) {

                                            }
                                        });
                                        //mTextField.setText("Message sent to 2nd list");
                                    }
                                }.start();
                            };
                        }
                    }

                    @Override
                    public void onCancelled(@NonNull DatabaseError databaseError) {

                    }
                });


                Log.d("yayyy","hiiii"+ dept);
            }
        });
    }
/*
    public String get_dept(){
        RadioGroup radioGroup= (RadioGroup) findViewById(R.id.radioGroup_dept);
        radioGroup.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                switch (checkedId){
                    case R.id.rb_HSE:
                        //Toast.makeText(getApplicationContext(),"Safety",Toast.LENGTH_LONG).show();
                        fetched_dept= "HSE";
                        break;
                    case R.id.rb_wareh:
                        //Toast.makeText(getApplicationContext(),"Warehouse",Toast.LENGTH_LONG).show();
                        fetched_dept= "Warehouse";
                        break;
                    case R.id.rb_quality:
                        //Toast.makeText(getApplicationContext(),"Quality",Toast.LENGTH_LONG).show();
                        fetched_dept= "Quality";
                        break;
                    case R.id.rb_Tooling:
                        //Toast.makeText(getApplicationContext(),"Other",Toast.LENGTH_LONG).show();
                        fetched_dept= "Tooling";
                        break;
                    case R.id.rb_methods:
                        //Toast.makeText(getApplicationContext(),"Other",Toast.LENGTH_LONG).show();
                        fetched_dept= "Methods and Tooling";
                        break;
                    case R.id.rb_Plantengg:
                        //Toast.makeText(getApplicationContext(),"Other",Toast.LENGTH_LONG).show();
                        fetched_dept= "Plant Engineering";
                        break;
                    default:
                        break;
                }
            }
        });
        return fetched_dept;
    }

    public String get_loc(){
        RadioGroup radioGroup= (RadioGroup) findViewById(R.id.radiogroup_locatn);
        radioGroup.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                switch (checkedId){
                    case R.id.rb_Black:
                        //Toast.makeText(getApplicationContext(),"Safety",Toast.LENGTH_LONG).show();
                        fetched_loc= "Black Steel";
                        break;
                    case R.id.rb_White:
                        //Toast.makeText(getApplicationContext(),"Warehouse",Toast.LENGTH_LONG).show();
                        fetched_loc= "White Steel";
                        break;
                    case R.id.rb_FinalA:
                        //Toast.makeText(getApplicationContext(),"Quality",Toast.LENGTH_LONG).show();
                        fetched_loc= "Final Assembly";
                        break;
                    case R.id.rb_Testing:
                        //Toast.makeText(getApplicationContext(),"Other",Toast.LENGTH_LONG).show();
                        fetched_loc= "Testing";
                        break;
                    default:
                        break;
                }
            }
        });
        return fetched_loc;
    }
*/
/*
    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {


        Log.d("hehehhehe","position"+ position);
        parent.getItemAtPosition(position);
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }*/

    public  void  checkbutton(View V){
        int radioId1 = radioGroup_dept.getCheckedRadioButtonId();
        radiobutton_dep = findViewById(radioId1);
    }

    public  void  checkbutton_loc(View V){
        int radioId2 = radioGroup_loc.getCheckedRadioButtonId();
        radiobutton_loc = findViewById(radioId2);
    }

}
