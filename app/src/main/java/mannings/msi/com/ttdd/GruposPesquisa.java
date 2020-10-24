package mannings.msi.com.ttdd;

import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.AssetManager;
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
import android.widget.Toast;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

import java.util.ArrayList;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

public class GruposPesquisa extends AppCompatActivity {

    private ListView listView;
    private ArrayList<String> mensagens;
    private ArrayAdapter<String> adapter;
    private Toolbar toolbar;
    private Document doc;
    private String[] array_mensagem = new String[100];
    private int[] array_proximo = new int[100];
    private String[] array_grupos = new String[100];
    SharedPreferences preferences;
    private int proxima_tela,gravou;
    private int count_proximo,pos,pos_max,proximo_max,indice_max,counter,proximo_buscado,numero_itens;
    private int id,indice,proximo;
    private String texto,grupo_buscado,grupo_max,mensagem_max,assunto_max,kind_max;
    private String grupo,kind,assunto,fase_corrente,fase_intermediaria,destinacao,observacoes;
    private String[] array_classes = new String[100];
    private String[] array_assunto = new String[100];
    private String[] array_fase_corrente = new String[100];
    private String[] array_fase_intermediaria = new String[100];
    private String[] array_destinacao = new String[100];
    private String[] array_observacoes = new String[255];
    private String fase_corrente_max,fase_intermediaria_max,destinacao_max,observacoes_max;
    private NodeList nodeContatos;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_grupos_pesquisa);
        listView=(ListView)findViewById(R.id.listViewGruposPesquisa);
        toolbar = (Toolbar) findViewById(R.id.toolbarGruposPesquisa);
        setSupportActionBar(toolbar);
        mensagens = new ArrayList<String>();
        adapter = new ArrayAdapter(GruposPesquisa.this, android.R.layout.simple_list_item_1,mensagens);
        listView.setAdapter( adapter );
        mensagens.clear();

        Bundle extras = getIntent().getExtras();
        grupo_buscado = extras.getString("grupo");

        try{
            AssetManager mngr = this.getAssets();
            DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
            doc = dBuilder.parse(mngr.open("xml/kind.xml"));

            doc.getDocumentElement().normalize();
            nodeContatos = doc.getElementsByTagName("row");
            counter = nodeContatos.getLength();
            int contador = 1;
            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    grupo = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(2).getChildNodes().item(0);
                    kind = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    assunto = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                    fase_corrente = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(5).getChildNodes().item(0);
                    fase_intermediaria = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(6).getChildNodes().item(0);
                    destinacao = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(7).getChildNodes().item(0);
                    observacoes = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(8).getChildNodes().item(0);
                    indice = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(9).getChildNodes().item(0);
                    proximo = Integer.parseInt(nodeNome.getNodeValue().toString());
                    texto = grupo + " " + assunto;

                    if (grupo.equals(grupo_buscado)) {
                        if (kind.equals("c")) pos = 1;
                        if (kind.equals("s")) pos = 2;
                        if (kind.equals("g")) pos = 3;
                        if (kind.equals("z")) pos = 4;
                        if (kind.equals("m")) pos = 5;
                        if (kind.equals("n")) pos = 6;

                        if (kind.equals(kind_max)) {
                            array_proximo[pos+contador]=proximo;
                            array_mensagem[pos+contador]=texto;
                            array_assunto[pos+contador]=assunto;
                            numero_itens=pos+contador;
                            array_fase_corrente[pos+contador]=fase_corrente;
                            array_fase_intermediaria[pos+contador]=fase_intermediaria;
                            array_destinacao[pos+contador]=destinacao;
                            array_observacoes[pos+contador]=observacoes;
                            contador = contador + 1;
                        }
                        else {
                            pos_max = pos;
                            numero_itens=pos_max;
                            kind_max = kind;
                            proximo_max = proximo;
                            indice_max = indice;
                            grupo_max = grupo;
                            assunto_max = assunto;
                            mensagem_max = texto;
                            fase_corrente_max = fase_corrente;
                            fase_intermediaria_max = fase_intermediaria;
                            destinacao_max = destinacao;
                            observacoes_max = observacoes;
                        }
                    }
                }
            }
            adapter.notifyDataSetChanged();
        } catch (Exception e) {
            e.printStackTrace();
        }

        if (pos_max>0){
            array_proximo[pos_max]=proximo_max;
            array_mensagem[pos_max]=mensagem_max;
            array_grupos[pos_max]=grupo_max;
            array_assunto[pos_max]=assunto_max;
            array_fase_corrente[pos_max]=fase_corrente_max;
            array_fase_intermediaria[pos_max]=fase_intermediaria_max;
            array_destinacao[pos_max]=destinacao_max;
            array_observacoes[pos_max]=observacoes_max;
        }

        if (pos_max>1){
            proximo_buscado=indice_max;
            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    grupo = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(2).getChildNodes().item(0);
                    kind = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    assunto = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                    fase_corrente = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(5).getChildNodes().item(0);
                    fase_intermediaria = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(6).getChildNodes().item(0);
                    destinacao = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(7).getChildNodes().item(0);
                    observacoes = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(8).getChildNodes().item(0);
                    indice = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(9).getChildNodes().item(0);
                    proximo = Integer.parseInt(nodeNome.getNodeValue().toString());
                    texto = grupo + " " + assunto;

                    if (proximo==proximo_buscado) {
                        if (kind.equals("c")) pos = 1;
                        if (kind.equals("s")) pos = 2;
                        if (kind.equals("g")) pos = 3;
                        if (kind.equals("z")) pos = 4;
                        if (kind.equals("m")) pos = 5;
                        if (kind.equals("n")) pos = 6;

                        pos_max = pos;
                        proximo_max = proximo;
                        grupo_max = grupo;
                        assunto_max = assunto;
                        mensagem_max = texto;
                        indice_max = indice;
                        fase_corrente_max = fase_corrente;
                        fase_intermediaria_max = fase_intermediaria;
                        destinacao_max = destinacao;
                        observacoes_max = observacoes;
                    }
                }
            }
            adapter.notifyDataSetChanged();

            if (pos_max>0){
                array_proximo[pos_max]=proximo_max;
                array_mensagem[pos_max]=mensagem_max;
                array_grupos[pos_max]=grupo_max;
                array_assunto[pos_max]=assunto_max;
                array_fase_corrente[pos_max]=fase_corrente_max;
                array_fase_intermediaria[pos_max]=fase_intermediaria_max;
                array_destinacao[pos_max]=destinacao_max;
                array_observacoes[pos_max]=observacoes_max;
            }

        }

        if (pos_max>1){
            proximo_buscado=indice_max;
            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    grupo = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(2).getChildNodes().item(0);
                    kind = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    assunto = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                    fase_corrente = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(5).getChildNodes().item(0);
                    fase_intermediaria = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(6).getChildNodes().item(0);
                    destinacao = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(7).getChildNodes().item(0);
                    observacoes = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(8).getChildNodes().item(0);
                    indice = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(9).getChildNodes().item(0);
                    proximo = Integer.parseInt(nodeNome.getNodeValue().toString());
                    texto = grupo + " " + assunto;

                    if (proximo==proximo_buscado) {
                        if (kind.equals("c")) pos = 1;
                        if (kind.equals("s")) pos = 2;
                        if (kind.equals("g")) pos = 3;
                        if (kind.equals("z")) pos = 4;
                        if (kind.equals("m")) pos = 5;
                        if (kind.equals("n")) pos = 6;

                        pos_max = pos;
                        proximo_max = proximo;
                        grupo_max = grupo;
                        assunto_max = assunto;
                        mensagem_max = texto;
                        indice_max = indice;
                        fase_corrente_max = fase_corrente;
                        fase_intermediaria_max = fase_intermediaria;
                        destinacao_max = destinacao;
                        observacoes_max = observacoes;
                    }
                }
            }
            adapter.notifyDataSetChanged();

            if (pos_max>0){
                array_proximo[pos_max]=proximo_max;
                array_mensagem[pos_max]=mensagem_max;
                array_grupos[pos_max]=grupo_max;
                array_assunto[pos_max]=assunto_max;
                array_fase_corrente[pos_max]=fase_corrente_max;
                array_fase_intermediaria[pos_max]=fase_intermediaria_max;
                array_destinacao[pos_max]=destinacao_max;
                array_observacoes[pos_max]=observacoes_max;
            }

        }

        if (pos_max>1){
            proximo_buscado=indice_max;
            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    grupo = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(2).getChildNodes().item(0);
                    kind = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    assunto = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                    fase_corrente = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(5).getChildNodes().item(0);
                    fase_intermediaria = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(6).getChildNodes().item(0);
                    destinacao = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(7).getChildNodes().item(0);
                    observacoes = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(8).getChildNodes().item(0);
                    indice = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(9).getChildNodes().item(0);
                    proximo = Integer.parseInt(nodeNome.getNodeValue().toString());
                    texto = grupo + " " + assunto;

                    if (proximo==proximo_buscado) {
                        if (kind.equals("c")) pos = 1;
                        if (kind.equals("s")) pos = 2;
                        if (kind.equals("g")) pos = 3;
                        if (kind.equals("z")) pos = 4;
                        if (kind.equals("m")) pos = 5;
                        if (kind.equals("n")) pos = 6;

                        pos_max = pos;
                        proximo_max = proximo;
                        grupo_max = grupo;
                        mensagem_max = texto;
                        assunto_max=assunto;
                        indice_max = indice;
                        fase_corrente_max = fase_corrente;
                        fase_intermediaria_max = fase_intermediaria;
                        destinacao_max = destinacao;
                        observacoes_max = observacoes;
                    }
                }
            }
            adapter.notifyDataSetChanged();

            if (pos_max>0){
                array_proximo[pos_max]=proximo_max;
                array_mensagem[pos_max]=mensagem_max;
                array_grupos[pos_max]=grupo_max;
                array_assunto[pos_max]=assunto;
                array_fase_corrente[pos_max]=fase_corrente_max;
                array_fase_intermediaria[pos_max]=fase_intermediaria_max;
                array_destinacao[pos_max]=destinacao_max;
                array_observacoes[pos_max]=observacoes_max;
            }

        }

        if (pos_max>1){
            proximo_buscado=indice_max;
            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    grupo = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(2).getChildNodes().item(0);
                    kind = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    assunto = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                    fase_corrente = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(5).getChildNodes().item(0);
                    fase_intermediaria = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(6).getChildNodes().item(0);
                    destinacao = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(7).getChildNodes().item(0);
                    observacoes = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(8).getChildNodes().item(0);
                    indice = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(9).getChildNodes().item(0);
                    proximo = Integer.parseInt(nodeNome.getNodeValue().toString());
                    texto = grupo + " " + assunto;

                    if (proximo==proximo_buscado) {
                        if (kind.equals("c")) pos = 1;
                        if (kind.equals("s")) pos = 2;
                        if (kind.equals("g")) pos = 3;
                        if (kind.equals("z")) pos = 4;
                        if (kind.equals("m")) pos = 5;
                        if (kind.equals("n")) pos = 6;

                        pos_max = pos;
                        proximo_max = proximo;
                        grupo_max = grupo;
                        assunto_max = assunto;
                        mensagem_max = texto;
                        indice_max = indice;
                        fase_corrente_max = fase_corrente;
                        fase_intermediaria_max = fase_intermediaria;
                        destinacao_max = destinacao;
                        observacoes_max = observacoes;

                    }
                }
            }
            adapter.notifyDataSetChanged();

            if (pos_max>0){
                array_proximo[pos_max]=proximo_max;
                array_mensagem[pos_max]=mensagem_max;
                array_grupos[pos_max]=grupo_max;
                array_assunto[pos_max]=assunto_max;
                array_fase_corrente[pos_max]=fase_corrente_max;
                array_fase_intermediaria[pos_max]=fase_intermediaria_max;
                array_destinacao[pos_max]=destinacao_max;
                array_observacoes[pos_max]=observacoes_max;
            }

        }

        if (pos_max>1){
            proximo_buscado=indice_max;
            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    grupo = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(2).getChildNodes().item(0);
                    kind = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    assunto = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                    fase_corrente = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(5).getChildNodes().item(0);
                    fase_intermediaria = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(6).getChildNodes().item(0);
                    destinacao = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(7).getChildNodes().item(0);
                    observacoes = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(8).getChildNodes().item(0);
                    indice = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(9).getChildNodes().item(0);
                    proximo = Integer.parseInt(nodeNome.getNodeValue().toString());
                    texto = grupo + " " + assunto;

                    if (proximo==proximo_buscado) {
                        if (kind.equals("c")) pos = 1;
                        if (kind.equals("s")) pos = 2;
                        if (kind.equals("g")) pos = 3;
                        if (kind.equals("z")) pos = 4;
                        if (kind.equals("m")) pos = 5;
                        if (kind.equals("n")) pos = 6;

                        pos_max = pos;
                        proximo_max = proximo;
                        grupo_max = grupo;
                        mensagem_max = texto;
                        assunto_max=assunto;
                        indice_max = indice;
                        fase_corrente_max = fase_corrente;
                        fase_intermediaria_max = fase_intermediaria;
                        destinacao_max = destinacao;
                        observacoes_max = observacoes;

                    }
                }
            }
            adapter.notifyDataSetChanged();

            if (pos_max>0){
                array_proximo[pos_max]=proximo_max;
                array_mensagem[pos_max]=mensagem_max;
                array_grupos[pos_max]=grupo_max;
                array_assunto[pos_max]=assunto_max;
                array_fase_corrente[pos_max]=fase_corrente_max;
                array_fase_intermediaria[pos_max]=fase_intermediaria_max;
                array_destinacao[pos_max]=destinacao_max;
                array_observacoes[pos_max]=observacoes_max;
            }

        }

        array_proximo[0]=0;
        array_mensagem[0]="<<<";
        mensagens.add(array_mensagem[0]);

        if (pos == 1) {
            String str = grupo_buscado.substring(0, 1);
            if (str.equals("0")) {
                array_proximo[1] = 1;
                array_mensagem[1] = "000 — ADMINISTRAÇÃO GERAL";
            }
            else {
                array_proximo[1] = 150;
                array_mensagem[1] = "900 — ADMINISTRAÇÃO DE ATIVIDADES ACESSÓRIAS";
            }
            mensagens.add(array_mensagem[1]);

            for (int i = 2; i <= numero_itens; i++) {
                texto = array_mensagem[i];
                mensagens.add(texto);
            }
            adapter.notifyDataSetChanged();
        }


        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                if (position==0) {
                    finish();
                }
                if (position==1) {
                    if (array_proximo[position]==0) {
                        String str2 = array_grupos[position];
                        Toast.makeText(getBaseContext(), "Este grupo "+str2+" não tem subgrupos ", Toast.LENGTH_LONG).show();
                    }
                    else {
                        Intent intent = new Intent(GruposPesquisa.this, KindS.class);
                        proxima_tela = array_proximo[position];
                        intent.putExtra("proxima_tela", proxima_tela);
                        startActivity(intent);
                    }
                }
                if (position==2) {
                    if (array_proximo[position]==0) {
                        String str2 = array_grupos[position];
                        Toast.makeText(getBaseContext(), "Este grupo "+str2+" não tem subgrupos ", Toast.LENGTH_LONG).show();
                    }
                    else {
                        Intent intent = new Intent(GruposPesquisa.this, KindG.class);
                        proxima_tela = array_proximo[position];
                        intent.putExtra("proxima_tela", proxima_tela);
                        startActivity(intent);
                    }
                }
                if (position==3) {
                    if (array_proximo[position]==0) {
                        String str2 = array_grupos[position];
                        Toast.makeText(getBaseContext(), "Este grupo "+str2+" não tem subgrupos ", Toast.LENGTH_LONG).show();
                    }
                    else {
                        Intent intent = new Intent(GruposPesquisa.this, KindZ.class);
                        proxima_tela = array_proximo[position];
                        intent.putExtra("proxima_tela", proxima_tela);
                        startActivity(intent);
                    }
                }
                if (position==4) {
                    if (array_proximo[position]==0) {
                        String str2 = array_grupos[position];
                        Toast.makeText(getBaseContext(), "Este grupo "+str2+" não tem subgrupos ", Toast.LENGTH_LONG).show();
                    }
                    else {
                        Intent intent = new Intent(GruposPesquisa.this, KindM.class);
                        proxima_tela = array_proximo[position];
                        intent.putExtra("proxima_tela", proxima_tela);
                        startActivity(intent);
                    }
                }
                if (position==5) {
                    if (array_proximo[position]==0) {
                        String str2 = array_grupos[position];
                        Toast.makeText(getBaseContext(), "Este grupo "+str2+" não tem subgrupos ", Toast.LENGTH_LONG).show();
                    }
                    else {
                        Intent intent = new Intent(GruposPesquisa.this, KindN.class);
                        proxima_tela = array_proximo[position];
                        intent.putExtra("proxima_tela", proxima_tela);
                        startActivity(intent);
                    }
                }
                if (position==6) {
                    String str2 = array_grupos[position];
                    Toast.makeText(getBaseContext(), "Este grupo "+str2+" não tem subgrupos ", Toast.LENGTH_LONG).show();
                }

            }
        });

        listView.setLongClickable(true);
        listView.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener(){
            @Override
            public boolean onItemLongClick(AdapterView<?> av, View v, int pos, long id)
            {
                if (array_fase_corrente[pos].equals(" ")&&
                        array_fase_intermediaria[pos].equals(" ")&&
                        array_destinacao[pos].equals(" ")&&
                        array_observacoes[pos].equals(" ")){

                    Toast.makeText(GruposPesquisa.this, "Não há dados de temporalidade", Toast.LENGTH_LONG).show();

                }
                else {
                    if (array_observacoes[pos].equals(" ")) {
                        texto = "Fase corrente: " + array_fase_corrente[pos] + "\n" +
                                "Fase intermediária: " + array_fase_intermediaria[pos] + "\n" +
                                "Destinação: " + array_destinacao[pos];
                    } else {
                        texto = "Fase corrente: " + array_fase_corrente[pos] + "\n" +
                                "Fase intermediária: " + array_fase_intermediaria[pos] + "\n" +
                                "Destinação: " + array_destinacao[pos] + "\n" +
                                "Observações: " + array_observacoes[pos];
                    }
                    //Toast.makeText(GruposPesquisa.this, texto, Toast.LENGTH_LONG).show();
                    Intent intent = new Intent(GruposPesquisa.this, Temporal.class);
                    String iclasses = array_grupos[pos];
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

                }

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
