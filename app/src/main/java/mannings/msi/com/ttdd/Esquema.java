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
import android.widget.ListView;

import java.util.ArrayList;

public class Esquema extends AppCompatActivity {

    private ListView listView;
    private ArrayList<String> mensagens;
    private ArrayAdapter<String> adapter;
    private Toolbar toolbar;
    SharedPreferences preferences;
    private int[] array_proximo = {1,150};
    private int proxima_tela;

    private String[] descricao = {
            "000 — ADMINISTRAÇÃO GERAL",
            "900 — ADMINISTRAÇÃO DE ATIVIDADES ACESSÓRIAS"
    };

    private String[] array_classes = {
            "000","900"
    };

    private String[] array_assunto = {
           "ADMINISTRAÇÃO GERAL", "ADMINISTRAÇÃO DE ATIVIDADES ACESSÓRIAS"
    };

    private String[] fase_corrente = {
            " "," "
    };

    private String[] array_fase_corrente = {
            " "," "
    };

    private String[] array_fase_intermediaria = {
            " "," "
    };

    private String[] array_destinacao = {
            " "," "
    };

    private String[] array_observacoes = {
            " "," "
    };


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_esquema);
        listView=(ListView)findViewById(R.id.listViewEsquema);
        toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putBoolean("app_encerrado", false);
        editor.apply();

        mensagens = new ArrayList<String>();
        adapter = new ArrayAdapter(Esquema.this, android.R.layout.simple_list_item_1,mensagens);
        listView.setAdapter( adapter );
        mensagens.clear();
        for (int i=0; i<descricao.length; i++)
        {
            mensagens.add(descricao[i]);
        }
        adapter.notifyDataSetChanged();

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(Esquema.this, KindS.class);
                proxima_tela = array_proximo[position];
                intent.putExtra("proxima_tela", proxima_tela);
                startActivity(intent);
            }
        });

        listView.setLongClickable(true);
        listView.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener(){
            @Override
            public boolean onItemLongClick(AdapterView<?> av, View v, int pos, long id)
            {
                Intent intent = new Intent(Esquema.this, Temporal.class);
                String iclasses = array_classes[pos];
                String iassunto = array_assunto[pos];
                String ifasecor = array_fase_corrente[pos];
                String ifaseint = array_fase_intermediaria[pos];
                String idestina = array_destinacao[pos];
                String iobserva = array_observacoes[pos];
                intent.putExtra("iclasses", iclasses);
                intent.putExtra("iassunto", iassunto);
                intent.putExtra("ifasecor", ifasecor);
                intent.putExtra("ifaseint", ifaseint);
                intent.putExtra("idestina", idestina);
                intent.putExtra("iobserva", iobserva);
                startActivity(intent);
                return true;
            }
        });

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
