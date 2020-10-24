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

public class Onosmatico extends AppCompatActivity {

    private ListView listView;
    private ArrayList<String> mensagens;
    private ArrayAdapter<String> adapter;
    private Toolbar toolbar;
    SharedPreferences preferences;
    private int[] array_proximo = {2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29};
    private int proxima_tela;

    private String[] descricao = {
            "ABASTECIMENTO E MANUTENÇÃO DE VEÍCULOS - AFASTAMENTOS",
            "ÁGUA E ESGOTAMENTO SANITÁRIO - Assembleias",
            "ASSENTAMENTO FUNCIONAL - Aviso prévio",
            "BAIXA - Bufê",
            "CADASTRAMENTO DE FORNECEDORES - Ciclo de palestras",
            "CIPA - COMUNICAÇÃO EXTERNA",
            "COMUNICAÇÃO INTERNA - Contas bancárias",
            "CONTAGEM E AVERBAÇÃO DE TEMPO DE SERVIÇO - Convite",
            "Convites para eventos - Cursos promovidos por outros órgãos",
            "DAÇÃO - DESPESA",
            "Doenças ocupacionais",
            "EDIÇÃO - Encontro",
            "ENERGIA ELÉTRICA - Eventos",
            "Falecimento de pessoal - Furto de veículos",
            "Gabaritos de provas - Guia de transferência",
            "HABILITAÇÃO - INCENTIVOS FUNCIONAIS",
            "INDENIZAÇÃO - IRRF",
            "Jardinagem - LOTAÇÃO",
            "Manuais de usuário - Multas",
            "Natalidade - Ouvidoria",
            "PAD - Planejamento estratégico",
            "PLANEJAMENTO INSTITUCIONAL - PROCRIAÇÃO",
            "Procuração - Publicidade",
            "Quinquênios - REEMBOLSO",
            "REESTRUTURAÇÃO - Reportagens",
            "Reposição salarial - Roubo de veículos",
            "Saída de material - Suspensão",
            "Tabela de temporalidade - VOTAÇÃO"
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_onosmatico);

        listView=(ListView)findViewById(R.id.listViewOnos);
        toolbar = (Toolbar) findViewById(R.id.toolbarOnos);
        setSupportActionBar(toolbar);

        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putBoolean("app_encerrado", false);
        editor.apply();

        mensagens = new ArrayList<String>();
        adapter = new ArrayAdapter(Onosmatico.this, android.R.layout.simple_list_item_1,mensagens);
        listView.setAdapter( adapter );
        mensagens.clear();
        //mensagens.add("<<<");
        for (int i=0; i<descricao.length; i++)
        {
            mensagens.add(descricao[i]);
        }
        adapter.notifyDataSetChanged();

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                    Intent intent = new Intent(Onosmatico.this, OnosS.class);
                    proxima_tela = array_proximo[position];
                    intent.putExtra("proxima_tela", proxima_tela);
                    startActivity(intent);
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
                //pesquisa_onosmatico();
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
