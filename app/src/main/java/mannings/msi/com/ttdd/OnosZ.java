package mannings.msi.com.ttdd;


import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.AssetManager;
import android.content.res.Resources;
import android.graphics.Point;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.Display;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

import java.util.ArrayList;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import mannings.msi.com.ttdd.adapter.RegistroAdapter2;
import mannings.msi.com.ttdd.model.Registro;
import mannings.msi.com.ttdd.model.RegistroOnos;
import mannings.msi.com.ttdd.model.RegistroOnos2;

public class OnosZ extends AppCompatActivity {

    private ListView listView;
    private Toolbar toolbar;
    SharedPreferences preferences;
    private int proxima_tela;
    private int count_proximo;
    private Document doc;
    private int id,indice,proximo;
    private String texto;
    private String grupo,kind,assunto,subassunto;
    private String[] array_classes = new String[40];
    private int[] array_proximo = new int[40];
    private ArrayList<RegistroOnos2> registros;
    private ArrayAdapter<RegistroOnos2> adapter;
    //private ArrayList<String> mensagens;
    //private ArrayAdapter<String> adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_onos_z);

        listView=(ListView)findViewById(R.id.listViewOnosZ);
        toolbar = (Toolbar) findViewById(R.id.toolbarOnosZ);
        setSupportActionBar(toolbar);

        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putBoolean("app_encerrado", false);
        editor.apply();

        Bundle extras = getIntent().getExtras();
        proxima_tela = extras.getInt("proxima_tela");

        //mensagens = new ArrayList<String>();
        //adapter = new ArrayAdapter(OnosG.this, android.R.layout.simple_list_item_1,mensagens);
        //listView.setAdapter( adapter );
        ///mensagens.clear();

        registros = new ArrayList<>();
        registros.clear();
        adapter = new RegistroAdapter2(OnosZ.this, registros );
        listView.setAdapter( adapter );
        adapter.notifyDataSetChanged();

        try{
            AssetManager mngr = this.getAssets();
            DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
            doc = dBuilder.parse(mngr.open("xml/onosmatico.xml"));

            doc.getDocumentElement().normalize();
            NodeList nodeContatos = doc.getElementsByTagName("row");
            int counter = nodeContatos.getLength();
            count_proximo=1;
            RegistroOnos2 registro0 = new RegistroOnos2();
            registro0.setAssunto("<<<");
            registro0.setSubAssunto(" ");
            registros.add(registro0);
            //mensagens.add("<<<");

            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    grupo = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    assunto = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                    subassunto = nodeNome.getNodeValue().toString();
                    if (!subassunto.equals(" ")) subassunto = "ver "+subassunto;
                    nodeNome = element.getElementsByTagName("field").item(5).getChildNodes().item(0);
                    indice = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(6).getChildNodes().item(0);
                    proximo = Integer.parseInt(nodeNome.getNodeValue().toString());

                    if (indice==proxima_tela) {
                        Display display = getWindowManager().getDefaultDisplay();
                        Point size = new Point();
                        display.getSize(size);
                        int width = size.x;
                        int height = size.y;
                        Resources r = OnosZ.this.getResources();
                        float densidade = r.getDisplayMetrics().density;
                        float widthsp = (int) ( width / getResources().getDisplayMetrics().scaledDensity );
                        int bordas = 16;
                        int largura_caracter = 10;
                        int intervalo = (int)((widthsp - bordas)/largura_caracter) - 1;

                        texto = assunto;
                        int total = intervalo - (assunto.length() + grupo.length());
                        if (total<0) {

                            int delta;
                            if (width==480)
                                delta = 17;
                            else if (width==720)
                                delta = 13;
                            else if (width==768)
                                delta = 11;
                            else if (width==1080)
                                delta = 8;
                            else if (width==1440)
                                delta = 8;
                            else if (width<720)
                                delta = (int) (((17-13)*width + 480*13 - 720*17)/(480-720));
                            else if (width>720 && width<768)
                                delta = (int) (((13-11)*width + 720*11 - 768*13)/(720-768));
                            else if (width>768 && width<1080)
                                delta = (int) (((11-8)*width + 768*8 - 1080*11)/(768-1080));
                            else
                                delta = 8;

                            if (id==112) // ANÁLISE DE DOCUMENTAÇÃO ARQUIVÍSTICA
                                total=27-delta;
                            else if (id==264) // CARTEIRAS DE IDENTIDADE FUNCIONAL
                                total=31-delta;
                            else if (id==275) // CATALOGAÇÃO DE DOCUMENTAÇÃO BIBLIOGRÁFICA
                                total=27-delta;
                            else if (id==299) // CÓDIGO DE CLASSIFICAÇÃO DE DOCUMENTOS DE ARQUIVO
                                total=33-delta;
                            else if (id==309) // COMISSÃO DE ACESSO À DOCUMENTAÇÃO ARQUIVÍSTICA
                                total=30-delta;
                            else if (id==310) // COMISSÃO INTERNA DE CONSERVAÇÃO DE ENERGIA-CICE
                                total=27-delta;
                            else if (id==311) // COMISSÃO INTERNA DE PREVENÇÃO DE ACIDENTES-CIPA
                                total=25-delta;
                            else if (id==312) // COMISSÃO PERMANENTE DE AVALIAÇÃO DE DOCUMENTOS
                                total=32-delta;
                            else if (id==444) // DESCENTRALIZAÇÃO DE RECURSOS ORÇAMENTÁRIOS
                                total=26-delta;
                            else if (id==464) // DESTINAÇÃO DE DOCUMENTAÇÃO ARQUIVÍSTICA
                                total=27-delta;
                            else if (id==468) // DIAGNÓSTICO DA PRODUÇÃO DOCUMENTAL
                                total=29-delta;
                            else if (id==562) // EDITAIS DE CIÊNCIA DE ELIMINAÇÃO DE DOCUMENTOS
                                total=29-delta;
                            else if (id==570) // ELIMINAÇÃO DE DOCUMENTAÇÃO ARQUIVÍSTICA
                                total=27-delta;
                            else if (id==609) // ESTORNOS DE RECURSOS ORÇAMENTÁRIOS
                                total=26-delta;
                            else if (id==674) // FUNDO DE GARANTIA POR TEMPO DE SERVIÇO-FGTS
                                total=26-delta;
                            else if (id==733) // INDEXAÇÃO DE DOCUMENTAÇÃO BIBLIOGRÁFICA
                                total=27-delta;
                            else if (id==757 || id==758) // INSTITUTO NACIONAL DO SEGURO SOCIAL-INSS
                                total=27-delta;
                            else if (id==819) // LISTAGENS DE ELIMINAÇÃO DE DOCUMENTOS
                                total=29-delta;
                            else if (id==1203) // PROGRAMA DE FORMAÇÃO DO PATRIMÔNIO DO SERVIDOR PÚBLICO-PASEP
                                total=15-delta;
                            else if (id==1204) // PROGRAMA DE INTEGRAÇÃO SOCIAL-PIS
                                total=27-delta;
                            else if (id==1250) // QUADRO DE DETALHAMENTO DE DESPESA-QDD
                                total=28-delta;
                            else if (id==1268) // RECOLHIMENTO DE DOCUMENTAÇÃO ARQUIVISTICA
                                total=27-delta;
                            else if (id==1315) // RELAÇÃO ANUAL DE INFORMAÇÕES SOCIAIS-RAIS
                                total=28-delta;
                            else if (id==1316) // RELAÇÕES DE RECOLHIMENTO DE DOCUMENTOS
                                total=29-delta;
                            else if (id==1326) // RELATÓRIO DE MOVIMENTAÇÃO DE ALMOXARIFADO-RMA
                                total=23-delta;
                            else if (id==1327) // RELATÓRIO DE MOVIMENTAÇÃO DE BENS IMÓVEIS-RMBI
                                total=29-delta;
                            else if (id==1328) // RELATÓRIO DE MOVIMENTAÇÃO DE BENS MÓVEIS-RMB/RMBM
                                total=35-delta;
                            else if (id==1446) // TABELAS DE TEMPORALIDADE DE DOCUMENTOS
                                total=29-delta;
                            else if (id==1464) // TERMOS DE ELIMINAÇÃO DE DOCUMENTOS
                                total=29-delta;
                            else if (id==1484) // TRANSFERÊNCIA DE DOCUMENTAÇÃO ARQUIVÍSTICA
                                total=27-delta;
                            else
                                total=35-delta;

                            texto = texto + " ";
                        }

                        if (!grupo.equals(" ")){
                            for (int j=0; j<=total; j++) texto = texto + ".";
                        }

                        texto = texto + grupo;

                        RegistroOnos2 registro2 = new RegistroOnos2();
                        registro2.setAssunto(texto);
                        registro2.setSubAssunto(subassunto);
                        registros.add( registro2 );

                        array_proximo[count_proximo]=proximo;
                        array_classes[count_proximo]=grupo;
                        count_proximo = count_proximo+1;
                    }
                }
            }
            adapter.notifyDataSetChanged();
        } catch (Exception e) {
            e.printStackTrace();
        }

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                if (position==0){
                    finish();
                }else {
                    grupo = array_classes[position];
                    if (grupo.equals(" ")) {
                        String str2 = array_classes[position];
                        Toast.makeText(getBaseContext(), "Não há subníveis para esta palavra", Toast.LENGTH_LONG).show();
                    }
                    else
                    {
                        Intent intent = new Intent(OnosZ.this, GruposPesquisa.class);
                        intent.putExtra("grupo", grupo);
                        startActivity(intent);
                    }
                }
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
