package mannings.msi.com.ttdd;

import android.app.Activity;
import android.app.ActivityManager;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.KeyEvent;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.view.ViewParent;
import android.view.inputmethod.InputMethodManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Arrays;

public class PesquisaEquiv extends AppCompatActivity {

    SharedPreferences preferences;
    private Toolbar toolbar;
    String[] simbolosValidos1 = {"000","001","002","003","004","010","010.1","010.2","010.3","011","012","012.1","012.11","012.12","012.2","012.3","019","019.01","020","020.1","020.2","020.3","020.31","020.4","020.5","021","021.1","021.2","022","022.1","022.11","022.12","022.121","022.122","022.2","022.21","022.22","022.221","022.222","022.9","023","023.01","023.02","023.03","023.1","023.11","023.12","023.13","023.14","023.15","024","024.1","024.11","024.111","024.112","024.119","024.12","024.121","024.122","024.123","024.124","024.13","024.131","024.132","024.133","024.134","024.135","024.136","024.137","024.139","024.14","024.141","024.142","024.143","024.144","024.145","024.149","024.15","024.151","024.152","024.153","024.154","024.155","024.156","024.2","024.3","024.4","024.5","024.51","024.52","024.59","024.9","024.91","024.92","025","025.1","025.11","025.12","026","026.01","026.1","026.11","026.12","026.13","026.131","026.132","026.19","026.191","026.192","026.193","026.194","026.195","026.2","026.21","026.22","026.23","029","029.1","029.11","029.2","029.21","029.22","029.221","029.222","029.3","029.31","029.4","029.5","029.6","029.7","030","030.1","031","032","033","033.1","033.11","033.12","033.13","033.2","033.21","033.22","033.23","034","034.01","034.1","034.2","034.3","034.4","034.5","035","035.1","035.2","036","036.1","036.2","037","037.1","037.2","039","040","041","041.01","041.011","041.012","041.013","041.02","041.1","041.11","041.12","041.13","041.14","041.15","041.2","041.21","041.22","041.23","041.24","041.3","041.4","041.41","041.42","041.5","041.51","041.52","041.53","041.54","041.59","042","042.1","042.11","042.12","042.13","042.2","042.3","042.31","042.32","042.4","042.5","042.9","042.91","042.911","042.912","042.913","043","044","049","049.1","049.11","049.12","049.13","049.14","049.15","049.2","049.21","049.22","049.3","050","050.1","051","051.1","051.11","051.12","051.13","051.14","051.2","051.21","051.22","051.23","052","052.1","052.2","052.21","052.22","053","054","055","055.01","055.1","055.2","056","057","059","059.1","060","060.1","060.2","060.3","061","061.1","061.2","062","062.01","062.1","062.11","062.12","062.13","062.2","062.3","062.4","062.5","063","063.01","063.1","063.2","063.3","063.4","063.5","063.51","063.6","063.61","063.62","063.63","064","065","066","066.1","066.2","066.3","067","067.1","067.2","067.21","067.22","067.3","069","070","071","071.1","071.11","071.12","071.2","071.3","071.9","072","072.1","073","073.1","074","074.1","074.2","074.3","075","079","090","091","900","910","920","930","940","990","991","992","993","994","995","996"};
    String[] simbolosValidos2 = {"000","011","015.1","015.2","001","010","012","013.1","013.2","005.1","005.2","061.011","061.012","019.1","019.112","019.111","019.12","019.113","019","991","020","010.01","020.01","020.2","023.18","023.186","020.033","020.031","020.11","020.12","020.13","020.14","021","021.2","021.1","021.3","021.4","021.5","024","024.1","024.11","024.12","024.13","024.2","024.3","024.31","024.32","024.33","024.4","-","020.02","020.021","020.022","023.12","022.2","022.1","022.7","022.21","022.3","022.4","022.5","022.22","023","023.11","023.1","026.1","023.13","023.14","023.191","023.15","023.151","023.152","023.153","023.154","023.155","023.156","023.157","023.16","023.161","023.162","023.163","023.164","023.165","023.166","023.167","023.17","023.171","023.172","023.173","023.174","023.175","023.181","023.182","023.183","023.184","026.2","023.185","023.2","023.3","026.4","023.4","023.7","023.71","023.72","023.73","023.91","023.92","023.93","023.5","023.6","027","027.1","027.2","026","026.01","026.3","026.91","026.51","026.52","026.53","026.54","026.02","026.61","026.62","026.9","025.11","025.14","025.31","025.32","025.311","025.312","025.22","029","029.12","029.11","028","028.11","028.12","028.2","028.23","028.21","028.22","029.3","029.4","029.5","004.21","004.22","020.032","030","030.01","030.02","030.03","069.2","031","031.11","031.1","031.41","031.5","031.21","031.12","031.22","031.42","034","032","032.01","032.1","033.6","032.2","032.3","033","033.11","033.12","033.21","033.22","033.51","033.52","035","036","036.1","036.2","039","040","040.01","043.1","045.1","045.11","045.12","045.13","049.1","043.2","041","041.11","041.51","041.21","041.61","042.6","042","042.11","042.51","042.21","042.4","043.3","043.4","045.3","045.32","045.31","045.2","045.21","045.22","045.23","045.24","041.1","041.12","041.62","041.22","041.52","044.1","044.2","042.12","042.22","042.52","045.5","044.3","044.6","044.4","044.5","041.13","041.23","041.4","041.53","042.13","042.23","042.53","042.72","045.6","045.7","047.01","047.1","047.2","047.3","049","045.4","046.2","045.01","046.11","046.12","046.13","046.3","046.4","043.6","043.61","043.62","043.7","050","054.1","054.2","051","051.1","051.2","051.4","051.3","052","052.1","052.2","052.211","052.212","052.213","052.221","052.222","052.24","052.251","052.252","053","053.1","053.2","053.3","052.23","059","059.2","060","069.3","065.1","065.2","065.3","062","060.01","062.1","062.11","062.12","062.13","062.21","062.22","063.1","063.2","062.3","061","061.3","061.1","061.4","061.51","061.52","061.521","061.522","061.523","062.41","062.42","064.31","064.32","064.01","064.1","064.2","064.4","066","066.1","066.2","067","069","070","071.1","071.2","071.3","071.4","073.32","073.31","073.33","071.5","073.4","004.11","004.12","900","910.01","911","912","913","914","915","916","917","918","919.1","920.01","921","922","990","992"};
    private Button buttonEquiv1,buttonEquiv2;
    private EditText editTextEquiv1,editTextEquiv2;
    private String grupo;
    private LinearLayout linearLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pesquisa_equiv);
        toolbar = (Toolbar) findViewById(R.id.toolbarEquiv);
        setSupportActionBar(toolbar);

        buttonEquiv1 = (Button)findViewById(R.id.buttonEquiv1);
        buttonEquiv2 = (Button)findViewById(R.id.buttonEquiv2);
        editTextEquiv1 = (EditText)findViewById(R.id.editTextEquiv1);
        editTextEquiv2 = (EditText)findViewById(R.id.editTextEquiv2);

        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putBoolean("app_encerrado", false);
        editor.apply();

        linearLayout = (LinearLayout)findViewById(R.id.linearLayout2);
        linearLayout.setOnTouchListener(new View.OnTouchListener() {
            @Override
            public boolean onTouch(View v, MotionEvent event) {
                hideKeyboardFrom(PesquisaEquiv.this,v);
                return false;
            }
        });

        buttonEquiv1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                grupo = editTextEquiv1.getText().toString();
                //EscondeTeclado(v);
                //hideKeyboardFrom(Pesquisa.this,v);

                if (!grupo.equals("")) {

                    grupo = grupo.replaceAll(" ", "");
                    grupo = grupo.replaceAll(",", ".");
                    grupo = grupo.toUpperCase();

                    if (Arrays.asList(simbolosValidos1).contains(grupo)) {

                        Intent intent = new Intent(PesquisaEquiv.this, GruposPesquisaEquiv1.class);
                        intent.putExtra("grupo", grupo);
                        startActivity(intent);

                    } else {

                        Toast.makeText(PesquisaEquiv.this, "Símbolo não identificado", Toast.LENGTH_LONG).show();
                    }
                }
                else{
                    Toast.makeText(PesquisaEquiv.this, "Nenhum símbolo digitado", Toast.LENGTH_LONG).show();
                }

            }
        });

        buttonEquiv2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                grupo = editTextEquiv2.getText().toString();

                if (!grupo.equals("")) {

                    grupo = grupo.replaceAll(" ", "");
                    grupo = grupo.replaceAll(",", ".");
                    grupo = grupo.toUpperCase();

                    if (Arrays.asList(simbolosValidos2).contains(grupo)) {

                        Intent intent = new Intent(PesquisaEquiv.this, GPesquisaEquiv2.class);
                        intent.putExtra("grupo", grupo);
                        startActivity(intent);

                    } else {

                        Toast.makeText(PesquisaEquiv.this, "Símbolo não identificado", Toast.LENGTH_LONG).show();
                    }
                }
                else{
                    Toast.makeText(PesquisaEquiv.this, "Nenhum símbolo digitado", Toast.LENGTH_LONG).show();
                }

            }
        });

    }

    public static void hideKeyboardFrom(Context context, View view) {
        InputMethodManager imm = (InputMethodManager) context.getSystemService(Activity.INPUT_METHOD_SERVICE);
        imm.hideSoftInputFromWindow(view.getWindowToken(), 0);
    }

    public void EscondeTeclado (View v){
        // https://stackoverflow.com/questions/13032436/hiding-softkeyboard-reliably
        // https://stackoverflow.com/questions/2036909/how-to-detect-when-a-user-taps-on-a-view-in-android
        // https://stackoverflow.com/questions/1109022/close-hide-android-soft-keyboard

        if (v!=null){
            InputMethodManager inputMethodManager = (InputMethodManager) getSystemService(this.INPUT_METHOD_SERVICE);
            inputMethodManager.hideSoftInputFromWindow(v.getWindowToken(),0);
        }

        //InputMethodManager imm = (InputMethodManager) getSystemService(Activity.INPUT_METHOD_SERVICE);
        //View view = findViewById(android.R.id.content).getRootView();
        //imm.hideSoftInputFromWindow(view.getWindowToken(), 0);
    }

    protected void onStart(){
        super.onStart();
        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        if (preferences.getBoolean("app_encerrado",false)) finish();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_main,menu);

        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch(item.getItemId()){
            case R.id.item_sair:
                preferences = getSharedPreferences("status_app", MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();
                editor.putBoolean("app_encerrado", true);
                editor.apply();
                finish();
                return true;
            case R.id.item_pesquisa:
                pesquisa();
                return true;
            case R.id.item_inicio:
                vaParaTelaInicial();
                return true;
            case R.id.item_busca_equiv:
                //pesquisaEquiv();
                return true;
            case R.id.item_equiv:
                TelaEquivalencia();
                return true;
            case R.id.item_about:
                TelaAbout();
                return true;
            case R.id.item_ajuda:
                TelaAjuda();
                return true;
            case R.id.item_onosmatico:
                pesquisa_onosmatico();
                return true;
            default:
                return super.onOptionsItemSelected(item);

        }

    }

    public void pesquisa_onosmatico(){
        Intent intent = new Intent(getApplicationContext(),Onosmatico.class);
        startActivity(intent);
        //finish();
    }

    public void pesquisa(){
        Intent intent = new Intent(getApplicationContext(),Pesquisa.class);
        startActivity(intent);
        //finish();
    }

    public void pesquisaEquiv(){
        Intent intent = new Intent(getApplicationContext(),PesquisaEquiv.class);
        startActivity(intent);
        //finish();
    }

    public void vaParaTelaInicial(){
        Intent intent = new Intent(getApplicationContext(),MainActivity.class);
        startActivity(intent);
        finish();
    }

    public void TelaAbout(){
        Intent intent = new Intent(getApplicationContext(),About.class);
        startActivity(intent);
        finish();
    }

    public void TelaAjuda(){
        Intent intent = new Intent(getApplicationContext(),Ajuda.class);
        startActivity(intent);
        finish();
    }

    public void TelaEquivalencia(){
        Intent intent = new Intent(getApplicationContext(),Equivalencia.class);
        startActivity(intent);
        finish();
    }

}
