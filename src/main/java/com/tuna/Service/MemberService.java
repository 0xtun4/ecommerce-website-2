package com.tuna.Service;

import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.repositories.response.LoginResponse;

public interface MemberService {
    String addMember(MemberDTO memberDTO);
    LoginResponse loginMember(LogInDTO loginDTO);
}
