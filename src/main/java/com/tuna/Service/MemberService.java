package com.tuna.Service;

import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.repositories.response.LoginResponse;

public interface MemberService {
    String addMember(MemberDTO memberDTO);

    String updateMember(MemberDTO memberDTO);

    String deleteMember(long memberId);

    LoginResponse loginMember(LogInDTO loginDTO);

}
