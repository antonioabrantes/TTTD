package mannings.msi.com.ttdd;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private Button btSobre,btBusca,btEquivalencia,btEsquema,btRemissivo,btBuscaEquivalencia;
    SharedPreferences preferences;
    Toolbar toolbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putBoolean("app_encerrado", false);
        editor.apply();

        btEsquema = (Button) findViewById(R.id.btEsquema);
        btEsquema.setOnClickListener(this);
        btEquivalencia = (Button) findViewById(R.id.btEquivalencia);
        btEquivalencia.setOnClickListener(this);
        btBusca = (Button) findViewById(R.id.btBusca);
        btBusca.setOnClickListener(this);
        btSobre = (Button) findViewById(R.id.btSobre);
        btSobre.setOnClickListener(this);
        btRemissivo = (Button) findViewById(R.id.btRemissivo);
        btRemissivo.setOnClickListener(this);
        btBuscaEquivalencia = (Button) findViewById(R.id.btBuscaEquivalencia);
        btBuscaEquivalencia.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        if(v == btEsquema) {
            Intent intent = new Intent(this, Esquema.class);
            startActivity(intent);
        } else if(v == btEquivalencia) {
            Intent intent = new Intent(this, Equivalencia.class);
            startActivity(intent);
        } else if(v == btBusca) {
            Intent intent = new Intent(this, Pesquisa.class);
            startActivity(intent);
        } else if(v == btSobre) {
            Intent intent = new Intent(this, About.class);
            startActivity(intent);
        } else if(v == btRemissivo) {
            Intent intent = new Intent(this, Onosmatico.class);
            startActivity(intent);
        } else if(v == btBuscaEquivalencia) {
            Intent intent = new Intent(this, PesquisaEquiv.class);
            startActivity(intent);
        }
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
                //vaParaTelaInicial();
                return true;
            case R.id.item_busca_equiv:
                pesquisaEquiv();
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
