import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class TransacaoService {
  private apiUrl = 'http://localhost:8000/transacao';

  constructor(private http: HttpClient) {}

  getTransacoes(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }

  createTransacao(descricao: string, valor: number, data: string, tipo_id: number): Observable<any> {
    const body = { descricao, valor, data, tipo_id };
    return this.http.post<any>(this.apiUrl, body);
  }

  updateTransacao(id: number, descricao: string, valor: number, data: string, tipo_id: number): Observable<any> {
    const body = { id, descricao, valor, data, tipo_id };
    return this.http.put<any>(this.apiUrl, body);
  }

  deleteTransacao(id: number): Observable<any> {
    const options = {
      headers: new HttpHeaders({ 'Content-Type': 'application/json' }),
      body: { id }
    };
    return this.http.delete<any>(this.apiUrl, options);
  }
}
